<?php
namespace App\System\RuleHandler;

use App\Helper\Interpretation;
use App\Helper\CLI;
use App\Helper\File;
use App\System\Config;
use App\System\DB;

Class InstallXML
{
    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/install_xml.php';
    }

    public static function getInstallXMLDistributor($integrationVersion)
    {
        $rules = static::getRules();

        foreach ($rules as $distributeVersion => $stringIntegrationVersions) {
            $integrationVersions = Interpretation::rangeToArray($stringIntegrationVersions);

            if (in_array($integrationVersion, $integrationVersions)) {
                return (string)$distributeVersion;
            }
        }
    }

    public static function applyModifications()
    {
        $configApp = Config::app();

        $fullVersions = $configApp['integration_versions'];
        $fullVersions[] = $configApp['distribution_version'];

        foreach ($fullVersions as $integrationVersion) {

            $xmlDistributorVersion = self::getInstallXMLDistributor($integrationVersion);
            $xml = File::read('install.xml', $xmlDistributorVersion);

            if (empty($xml)) {
                continue;
            }

            $database = $configApp['db']['database_prefix'] . $integrationVersion;
            $db = new DB($configApp['db']['hostname'], $configApp['db']['username'], $configApp['db']['password'], $database);

            $tableModificationRules = TableModification::getRules();
            $tableModificationRules = $tableModificationRules[TableModification::getKeyRulesByVersion($integrationVersion)];

            $db->query('DELETE FROM ' . $configApp['db']['table_prefix'] . 'modification WHERE `name` LIKE "%' . $tableModificationRules['name'] . '%"');

            if (!empty($tableModificationRules)) {
                $query = 'INSERT INTO ' . $configApp['db']['table_prefix'] . "modification SET ";
                foreach ($tableModificationRules as $name => $value) {
                    $value = str_replace('{xml}', $xml, $value);

                    $query .= " `{$name}` = '{$db->escape($value)}',";
                }
                $query = substr($query, 0, -1);

                $db->query($query);

                CLI::output('OC Modification for ' . $integrationVersion . ' apply!');
            }

            unset($db);
        }
    }
}
<?php
namespace App\System\RuleHandler;

use App\Helper\Interpretation;
use App\Helper\CLI;
use App\Helper\File;
use App\System\Config;
use App\System\DB;
use App\system\Rule;

Class InstallXML
{
    public static function run()
    {
        $rules = Rule::get(Rule::INSTALL_XML);
        $xmlTemplate = self::template();
        $xmlTemplate = str_replace('{name}', Config::get('app', 'module_name'), $xmlTemplate);
        $xmlTemplate = str_replace('{author}', Config::get('app', 'author'), $xmlTemplate);
        $xmlTemplate = str_replace('{site}', Config::get('app', 'site'), $xmlTemplate);
        $xmlTemplate = str_replace('{version}', Config::get('app', 'version'), $xmlTemplate);
        $xmlTemplate = str_replace('{code}', Config::get('app', 'modification_code'), $xmlTemplate);

        $allVersions = Config::get('app', 'integration_versions');
        if (!empty($rules['modifications'])) {
            foreach ($rules['modifications'] as $rangeVersionsString => $modification) {
                foreach ($allVersions as $version) {
                    if (Interpretation::inRange($rangeVersionsString, $version)) {
                        $xmlContent = str_replace('{modifications}', $modification, $xmlTemplate);
                        File::write('install.xml', $xmlContent, $version);
                    }
                }
            }
        }

        self::applyModifications();
    }

    public static function applyModifications()
    {
        $configApp = Config::app();
        $integrationsVersions = $configApp['integration_versions'];
        foreach ($integrationsVersions as $integrationVersion) {

            $xml = File::read('install.xml', $integrationVersion);

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

    protected static function template()
    {
        return <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<modification>
    <name>
        <![CDATA[ {name} ]]>
    </name>
    <version> {version} </version>
    <link>{site}</link>
    <author>
        <![CDATA[<b>{email}</b>]]>
    </author>
    <code> {code} </code>
    {modifications}
</modification>
EOF;
    }
}
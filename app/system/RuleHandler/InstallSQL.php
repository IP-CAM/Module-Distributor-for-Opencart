<?php
namespace App\System\RuleHandler;

use App\Helper\Interpretation;

Class InstallSQL
{
    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/install_sql.php';
    }

    public static function getInstallSQLDistributor($integrationVersion)
    {
        $rules = static::getRules();

        foreach ($rules as $distributeVersion => $stringIntegrationVersions) {
            $integrationVersions = Interpretation::rangeToArray($stringIntegrationVersions);

            if (in_array($integrationVersion, $integrationVersions)) {
                return (string)$distributeVersion;
            }
        }
    }
}
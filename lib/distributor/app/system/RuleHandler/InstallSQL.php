<?php
namespace App\System\RuleHandler;

use App\Helper\Interpretation;
use App\system\Rule;

Class InstallSQL
{
    public static function getInstallSQLDistributor($integrationVersion)
    {
        $rules = Rule::get(Rule::INSTALL_SQL);
        foreach ($rules as $distributeVersion => $stringIntegrationVersions) {
            $integrationVersions = Interpretation::rangeToArray($stringIntegrationVersions);
            if (in_array($integrationVersion, $integrationVersions)) {
                return (string)$distributeVersion;
            }
        }
    }
}
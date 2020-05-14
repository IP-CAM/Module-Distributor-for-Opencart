<?php
namespace App\System\RuleHandler;

use App\Helper\Interpretation;
use App\system\Rule;

Class InstallPHP
{
    public static function getInstallPHPDistributor($integrationVersion)
    {
        $rules = Rule::get(Rule::INSTALL_PHP);
        foreach ($rules as $distributeVersion => $stringIntegrationVersions) {
            $integrationVersions = Interpretation::rangeToArray($stringIntegrationVersions);

            if (in_array($integrationVersion, $integrationVersions)) {
                return (string)$distributeVersion;
            }
        }
    }
}
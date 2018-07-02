<?php
namespace App\System\RuleHandler;

use App\Helper\Interpretation;

Class InstallPHP
{
    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/install_php.php';
    }

    public static function getInstallPHPDistributor($integrationVersion)
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
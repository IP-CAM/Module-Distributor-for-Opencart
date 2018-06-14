<?php
namespace App\System\RuleHandler;

use App\Helper\Interpretation;

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
}
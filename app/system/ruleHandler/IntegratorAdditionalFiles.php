<?php

namespace App\System\RuleHandler;

use App\System\Config;
use App\Helper\FileSystem;
use App\Helper\Replacer;
use App\Helper\Interpretation;


Class IntegratorAdditionalFiles extends Integrator
{
    protected static $storageConformity = null;

    public static function distribute($integrationVersion)
    {
        $additionalFiles = static::getRules();
        if ($additionalFiles && isset($additionalFiles[static::getKeyRulesByVersion($integrationVersion)])) {

            $basePath = Config::get('app', 'base_path_to_project');
            foreach ($additionalFiles[static::getKeyRulesByVersion($integrationVersion)] as $rules) {
                $distributeVersion = $rules[0];
                $fileFromTo = (gettype($rules[1]) == 'array') ? $rules[1] : [$rules[1], $rules[1]];
                $replaceRules = $rules[2];

                $distributeFilePath = $basePath . $distributeVersion . '/' . $fileFromTo[0];
                $integrationFilePath = $basePath . $integrationVersion . '/' . $fileFromTo[1];

                FileSystem::createDirByFile($integrationFilePath);
                FileSystem::copyFile($distributeFilePath, $integrationFilePath);

                if ($replaceRules) {
                    foreach ($replaceRules as $searchReplace) {
                        Replacer::replaceInFile($searchReplace[0], $searchReplace[1], $integrationFilePath);
                    }
                }
            }
        }
    }

    public static function getDistributorToIntegration($integrationVersion)
    {
        $rules = static::getRules();

        foreach ($rules as $distributeVersion => $stringIntegrationVersions) {
            $integrationVersions = Interpretation::rangeToArray($stringIntegrationVersions);

            if (in_array($integrationVersion, $integrationVersions)) {
                return (string)$distributeVersion;
            }
        }
    }

    public static function getRules()
    {
        return FilesToDistribute::getAdditionalFiles();
    }
}
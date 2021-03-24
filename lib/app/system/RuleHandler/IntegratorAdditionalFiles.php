<?php

namespace App\System\RuleHandler;

use App\Helper\FileSystem;
use App\Helper\File;


Class IntegratorAdditionalFiles extends Integrator
{
    protected static $storageConformity = null;

    public static function distribute($integrationVersion)
    {
        $additionalFiles = static::getRules();
        if ($additionalFiles && isset($additionalFiles[static::getKeyRulesByVersion($integrationVersion)])) {

            foreach ($additionalFiles[static::getKeyRulesByVersion($integrationVersion)] as $rules) {
                $distributeVersion = $rules[0];
                $fileFromTo = (gettype($rules[1]) == 'array') ? $rules[1] : [$rules[1], $rules[1]];
                $replaceRules = $rules[2] ?? null;

                $distributeFilePath = $distributeVersion . '/' . $fileFromTo[0];
                $integrationFilePath = $integrationVersion . '/' . $fileFromTo[1];

                FileSystem::createDirByFile($integrationFilePath);
                FileSystem::copyFile($distributeFilePath, $integrationFilePath);

                if ($replaceRules) {
                    foreach ($replaceRules as $searchReplace) {
                        File::replaceText($searchReplace[0], $searchReplace[1], $integrationFilePath);
                    }
                }
            }
        }
    }

    public static function getRules()
    {
        return FilesToDistribute::getAdditionalFiles();
    }
}
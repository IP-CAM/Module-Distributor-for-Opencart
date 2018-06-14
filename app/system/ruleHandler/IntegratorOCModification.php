<?php

namespace App\System\RuleHandler;

use App\System\Config;
use App\Helper\FileSystem;
use App\Helper\Replacer;

Class IntegratorOCModification extends Integrator
{
    protected static $storageConformity = null;

    public static function distribute($integrationVersion)
    {
        $modifications = static::getRules();
        if ($modifications && isset($modifications[static::getKeyRulesByVersion($integrationVersion)])) {

            $basePath = Config::get('app', 'base_path_to_project');
            foreach ($modifications[static::getKeyRulesByVersion($integrationVersion)] as $rules) {
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

    public static function getRules()
    {
        return Config::get('filesToDistribute', 'oc_modification');
    }
}
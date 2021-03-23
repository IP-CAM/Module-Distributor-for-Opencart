<?php

namespace App\System;

use App\Helper\CLI;
use App\Helper\File;
use App\Helper\FileSystem;
use App\System\RuleHandler\Obfuscator as ObfuscatorHandler;
use App\Helper\Obfuscator as ObfuscatorHelper;

Class Obfuscator
{
    public static function run()
    {
        $obfuscatorHelper = new ObfuscatorHelper();

        $collectorRules = Collector::getRules();
        $obfuscatorRules = ObfuscatorHandler::getRules();

        if ($obfuscatorRules) {
            foreach ($collectorRules['main_versions'] as $mainVersion) {
                $obfuscatorKey = ObfuscatorHandler::getKeyRulesByVersion($mainVersion);
                foreach ($obfuscatorRules[$obfuscatorKey] as $file) {
                    $baseDir = Config::get('app', 'base_path_to_project');
                    $collectorFolder = $collectorRules['folder'];

                    $fileToObfuscate = $baseDir . $collectorFolder . $mainVersion . '/upload/' . $file;

                    if (File::isExists($fileToObfuscate)) {
                        FileSystem::copyFile($fileToObfuscate, $fileToObfuscate . ObfuscatorHandler::$postfix);
                        $obfuscatorHelper->obfuscateFileFromTo($fileToObfuscate . ObfuscatorHandler::$postfix, $fileToObfuscate);

                        CLI::output('File ' . $fileToObfuscate . ' is obfuscated');
                    }
                }
            }
        }
    }
}
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

        $archivatorRules = Rule::get(Rule::ARCHIVATOR);
        $obfuscatorRules = ObfuscatorHandler::getRules();

        if ($obfuscatorRules) {
            foreach ($archivatorRules as $mainVersion => $archivatorRule) {
                $obfuscatorKey = ObfuscatorHandler::getKeyRulesByVersion($mainVersion);
                foreach ($obfuscatorRules[$obfuscatorKey] as $file) {
                    $collectorFolder = Config::get('app', 'collection_folder');

                    $fileToObfuscate = $collectorFolder . $mainVersion . '/upload/' . $file;

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
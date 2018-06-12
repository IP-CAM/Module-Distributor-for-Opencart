<?php

namespace App;

use App\System\Config;
use App\System\Rules\Structure;
use App\Helper\FileSystem;
use App\Helper\CLI;

Class Controller
{
    public static function run() {
        $configApp = Config::app();
        $filesToDistribute = Config::filesToDistribute();
        $structureRules = Structure::getRules();

        foreach ($configApp['integration_versions'] as $integrationVersion) {
            foreach ($filesToDistribute as $adminCatalogDirName => $adminCatalogDirs) {
                foreach ($adminCatalogDirs as $mvcDirName => $files) {
                    foreach ($files as $file) {
                        $structureDirFileToCopy = $structureRules[$structureRules['conformity'][$configApp['distribution_version']]][$adminCatalogDirName][$mvcDirName];
                        $fileToCopy = FileSystem::parentDir() . $configApp['distribution_version'] . '/' . $structureDirFileToCopy . $file;

                        $structureDirNewFile = $structureRules[$structureRules['conformity'][$integrationVersion]][$adminCatalogDirName][$mvcDirName];
                        $newFile = FileSystem::parentDir() . $integrationVersion . '/' . $structureDirNewFile . $file;
                        FileSystem::createDirByFile($newFile);

                        FileSystem::copyFile($fileToCopy, $newFile);

                        CLI::output("({$integrationVersion}) $adminCatalogDirName $mvcDirName $file created!");
                    }
                }
            }
        }
    }
}
<?php

namespace App;

use App\System\Config;
use App\System\Rules\Structure;
use App\System\Rules\Copy;
use App\System\Rules\Format;
use App\System\Rules\Controller as ControllerRules;
use App\Helper\FileSystem;
use App\Helper\CLI;

Class Controller
{
    public static function run() {
        $configApp = Config::app();
        $filesToDistribute = Config::filesToDistribute();

        foreach ($configApp['integration_versions'] as $integrationVersion) {
            foreach ($filesToDistribute as $adminCatalogDirName => $adminCatalogDirs) {
                foreach ($adminCatalogDirs as $mvcDirName => $files) {
                    foreach ($files as $file) {
                        Format::addFormatToFileIfNotExists($integrationVersion, $mvcDirName,$file);
                        $newFile = self::copyFile($integrationVersion, $adminCatalogDirName, $mvcDirName, $file);
                        self::integrate($integrationVersion, $adminCatalogDirName, $newFile);
                    }
                }
            }
        }
    }

    private static function copyFile($integrationVersion, $adminCatalogDirName, $mvcDirName, $file)
    {
        $structureRules = Structure::getRules();

        $distributionVersion = Copy::getDistributeVersion($integrationVersion, $mvcDirName);

        $structureDirFileToCopy = $structureRules[Structure::conformity($distributionVersion)][$adminCatalogDirName][$mvcDirName];
        $fileToCopy = FileSystem::parentDir(2) . $distributionVersion . '/' . $structureDirFileToCopy . $file;

        $structureDirNewFile = $structureRules[Structure::conformity($integrationVersion)][$adminCatalogDirName][$mvcDirName];
        $newFile = FileSystem::parentDir(2) . $integrationVersion . '/' . $structureDirNewFile . $file;

        FileSystem::createDirByFile($newFile);
        FileSystem::copyFile($fileToCopy, $newFile);

        CLI::output("({$integrationVersion}) $adminCatalogDirName $mvcDirName $file created!");

        return $newFile;
    }

    private static function integrate($integrationVersion, $adminCatalogDirName, $newFile)
    {
        ControllerRules::integrateToVersion($integrationVersion, $adminCatalogDirName, $newFile);
    }
}
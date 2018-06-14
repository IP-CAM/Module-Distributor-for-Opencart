<?php

namespace App;

use App\System\Config;
use App\System\Rules\Structure;
use App\System\Rules\Copy;
use App\System\Rules\Format;
use App\System\Rules\IntegratorController;
use App\System\Rules\IntegratorModel;
use App\System\Rules\IntegratorView;

use App\Helper\FileSystem;
use App\Helper\CLI;

Class Controller
{
    public static function run() {
        $configApp = Config::app();
        $filesToDistribute = Config::filesToDistribute();

        foreach ($configApp['integration_versions'] as $integrationVersion) {
            foreach ($filesToDistribute as $adminCatalogDir => $adminCatalogDirs) {
                foreach ($adminCatalogDirs as $mvcDir => $files) {
                    foreach ($files as $file) {
                        Format::addFormatToFileIfNotExists($integrationVersion, $mvcDir,$file);
                        $newFile = self::copyFile($integrationVersion, $adminCatalogDir, $mvcDir, $file);
//                        self::integrate($integrationVersion, $adminCatalogDirName, $newFile);
                    }
                }
            }
        }
    }

    private static function copyFile($integrationVersion, $adminCatalogDir, $mvcDir, $file)
    {
        $distributionVersion = Copy::getDistributeVersion($integrationVersion, $mvcDir);

        $structureDirFileToCopy = Structure::getPath($distributionVersion, $adminCatalogDir, $mvcDir);
        $fileToCopy = Config::get('app', 'base_path_to_project') . $distributionVersion . '/' . $structureDirFileToCopy . $file;

        $structureDirNewFile = Structure::getPath($integrationVersion, $adminCatalogDir, $mvcDir);
        $newFile = Config::get('app', 'base_path_to_project') . $integrationVersion . '/' . $structureDirNewFile . $file;

        FileSystem::createDirByFile($newFile);
        FileSystem::copyFile($fileToCopy, $newFile);

        CLI::output("({$integrationVersion}) $adminCatalogDir $mvcDir $file created!");

        return $newFile;
    }

    private static function integrate($integrationVersion, $adminCatalogDirName, $newFile)
    {
        IntegratorController::integrateToVersion($integrationVersion, $adminCatalogDirName, $newFile);
        IntegratorModel::integrateToVersion($integrationVersion, $adminCatalogDirName, $newFile);
        IntegratorView::integrateToVersion($integrationVersion, $adminCatalogDirName, $newFile);

        CLI::output("({$integrationVersion}) $newFile integrated!");
    }
}
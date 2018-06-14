<?php

namespace App;

use App\System\Config;
use App\System\RuleHandler\Integrator;
use App\System\RuleHandler\Structure;
use App\System\RuleHandler\Copy;
use App\System\RuleHandler\Format;
use App\System\RuleHandler\IntegratorController;
use App\System\RuleHandler\IntegratorModel;
use App\System\RuleHandler\IntegratorView;

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
                        self::integrate($integrationVersion, $adminCatalogDir, $mvcDir, $newFile);
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

    private static function integrate($integrationVersion, $adminCatalogDir, $mvcDir, $newFile)
    {
        /**
         * @var Integrator $className
         */
        $className = 'App\System\RuleHandler\Integrator' . ucfirst($mvcDir);
        if (class_exists($className)) {
            $className::integrateToVersion($integrationVersion, $adminCatalogDir, $newFile);
        }

        CLI::output("({$integrationVersion}) " . pathinfo($newFile, PATHINFO_FILENAME) . " integrated!");
    }
}
<?php

namespace App;

use App\System\Config;
use App\System\RuleHandler\FilesToDistribute;
use App\System\RuleHandler\Integrator;
use App\System\RuleHandler\Structure;
use App\System\RuleHandler\Copy;
use App\System\RuleHandler\Format;
use App\System\RuleHandler\IntegratorOCModification;
use App\System\RuleHandler\Collector;
use App\System\RuleHandler\IntegratorAdditionalFiles;
use App\System\RuleHandler\Archivator;

use App\Helper\FileSystem;
use App\Helper\CLI;

Class Controller
{
    public static function run() {
        $configApp = Config::app();

        //Distribute modules to other project versions
        foreach ($configApp['integration_versions'] as $integrationVersion) {
            foreach (FilesToDistribute::getModuleFiles() as $adminCatalogDir => $adminCatalogDirs) {
                foreach ($adminCatalogDirs as $mvcDir => $files) {
                    foreach ($files as $file) {
                        Format::addFormatToFileIfNotExists($integrationVersion, $mvcDir,$file);
                        $newFile = self::copyFile($integrationVersion, $adminCatalogDir, $mvcDir, $file);
                        self::integrate($integrationVersion, $adminCatalogDir, $mvcDir, $newFile);
                    }
                }
            }
        }

        //Distribute additional_files to other project versions
        foreach ($configApp['integration_versions'] as $integrationVersion) {
            IntegratorAdditionalFiles::distribute($integrationVersion);
            CLI::output('OC Additional file ' . $integrationVersion . ' apply!');
        }

        //Distribute oc_modification to other project versions
        foreach ($configApp['integration_versions'] as $integrationVersion) {
            IntegratorOCModification::distribute($integrationVersion);
            CLI::output('OC Modification ' . $integrationVersion . ' apply!');
        }
        
        Collector::run();

        Archivator::run();
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
<?php

namespace App\System\RuleHandler;

use App\System\Config;
use App\Helper\FileSystem;
use App\Helper\CLI;

Class Collector
{
    public static function run()
    {
        $rules = self::getRules();
        foreach ($rules['main_versions'] as $mainVersion) {
            foreach (Config::get('filesToDistribute', 'module') as $adminCatalogDir => $adminCatalogDirs) {
                foreach ($adminCatalogDirs as $mvcDir => $files) {
                    foreach ($files as $file) {
                        Format::addFormatToFileIfNotExists($mainVersion, $mvcDir, $file);
                        self::copyFile($mainVersion, $adminCatalogDir, $mvcDir, $file);
                    }
                }
            }
        }

        //Collect install xml
        foreach ($rules['main_versions'] as $mainVersion) {
            self::copyInstallXML($mainVersion);
        }
    }

    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/collector.php';
    }

    private static function copyInstallXML($mainVersion)
    {
        $rules = self::getRules();

        $distributorVersion = InstallXML::getInstallXMLDistributor($mainVersion);

        $baseDir = Config::get('app', 'base_path_to_project');
        $fileFrom = $baseDir . $distributorVersion . '/install.xml';
        $fileTo = $baseDir . $rules['folder'] . $mainVersion . '/install.xml';

        FileSystem::copyFile($fileFrom, $fileTo);

        CLI::output('(' . $mainVersion . ') install.xml created!');
    }

    private static function copyFile($mainVersion, $adminCatalogDir, $mvcDir, $file)
    {
        $rules = self::getRules();

        $structureDirFileToCopy = Structure::getPath($mainVersion, $adminCatalogDir, $mvcDir);
        $baseDir = Config::get('app', 'base_path_to_project');

        $fileToCopy = $baseDir . $mainVersion . '/' . $structureDirFileToCopy . $file;

        $collectorFolder = $rules['folder'];
        $newFile = $baseDir . $collectorFolder . $mainVersion . '/upload/' . $structureDirFileToCopy . $file;

        FileSystem::createDirByFile($newFile);
        FileSystem::copyFile($fileToCopy, $newFile);

        CLI::output("({$mainVersion}) {$adminCatalogDir} {$mvcDir} {$file} collected!");

        return $newFile;
    }
}
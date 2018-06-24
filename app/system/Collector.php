<?php

namespace App\System;

use App\System\RuleHandler\FilesToDistribute;
use App\System\RuleHandler\Format;
use App\System\RuleHandler\InstallXML;
use App\System\RuleHandler\Structure;
use App\System\RuleHandler\IntegratorAdditionalFiles;

use App\Helper\FileSystem;
use App\Helper\CLI;
use App\Helper\File;

Class Collector
{
    public static function run()
    {
        $rules = self::getRules();
        foreach ($rules['main_versions'] as $mainVersion) {
            foreach (FilesToDistribute::getModuleFiles() as $adminCatalogDir => $adminCatalogDirs) {
                foreach ($adminCatalogDirs as $mvcDir => $files) {
                    foreach ($files as $file) {
                        Format::addFormatToFileIfNotExists($mainVersion, $mvcDir, $file);
                        self::copyModuleFiles($mainVersion, $adminCatalogDir, $mvcDir, $file);
                    }
                }
            }
        }

        //Collect additional files
        foreach ($rules['main_versions'] as $mainVersion) {
            self::copyAdditionalFiles($mainVersion);
        }

        //Collect install xml
        foreach ($rules['main_versions'] as $mainVersion) {
            self::copyInstallXML($mainVersion);
        }
    }

    public static function getRules()
    {
        return require __DIR__ . '/../../rules/collector.php';
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

    private static function copyModuleFiles($mainVersion, $adminCatalogDir, $mvcDir, $file)
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

    private static function copyAdditionalFiles($mainVersion)
    {
        $additionalFiles = IntegratorAdditionalFiles::getRules();
        $collectorRules = static::getRules();

        if ($additionalFiles && isset($additionalFiles[IntegratorAdditionalFiles::getKeyRulesByVersion($mainVersion)])) {

            $basePath = Config::get('app', 'base_path_to_project');
            foreach ($additionalFiles[IntegratorAdditionalFiles::getKeyRulesByVersion($mainVersion)] as $rules) {
                $distributeVersion = $rules[0];
                $fileFromTo = (gettype($rules[1]) == 'array') ? $rules[1] : [$rules[1], $rules[1]];
                $replaceRules = $rules[2];

                $distributeFilePath = $basePath . $distributeVersion . '/' . $fileFromTo[0];

                $collectorFolder = $collectorRules['folder'];
                $integrationFilePath = $basePath . $collectorFolder . $mainVersion . '/upload/' . $fileFromTo[1];

                FileSystem::createDirByFile($integrationFilePath);
                FileSystem::copyFile($distributeFilePath, $integrationFilePath);

                if ($replaceRules) {
                    foreach ($replaceRules as $searchReplace) {
                        File::replaceText($searchReplace[0], $searchReplace[1], $integrationFilePath);
                    }
                }

                CLI::output('(' . $mainVersion . ') ' . $fileFromTo[1] . ' additional collected!');
            }
        }
    }
}
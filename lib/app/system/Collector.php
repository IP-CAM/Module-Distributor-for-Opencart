<?php

namespace App\System;

use App\System\RuleHandler\FilesToDistribute;
use App\System\RuleHandler\Format;
use App\System\RuleHandler\InstallXML;
use App\System\RuleHandler\InstallSQL;
use App\System\RuleHandler\InstallPHP;
use App\System\RuleHandler\Structure;
use App\System\RuleHandler\IntegratorAdditionalFiles;

use App\Helper\FileSystem;
use App\Helper\CLI;
use App\Helper\File;

Class Collector
{
    public static function run()
    {
        $rules = Rule::get(Rule::ARCHIVATOR);
        foreach ($rules as $mainVersion => $rule) {
            foreach (FilesToDistribute::getModuleFiles() as $adminCatalogDir => $adminCatalogDirs) {
                foreach ($adminCatalogDirs as $mvcDir => $files) {
                    foreach ($files as $file) {
                        $file = $file . Format::makeFormatIfNotExists($mainVersion, $mvcDir, $file);
                        self::copyModuleFiles($mainVersion, $adminCatalogDir, $mvcDir, $file);
                    }
                }
            }

            self::copyAdditionalFiles($mainVersion);
            self::copyInstallXML($mainVersion);
            self::copyInstallSQL($mainVersion);
            self::copyInstallPHP($mainVersion);
        }
    }

    private static function copyInstallXML($mainVersion)
    {
        $fileFrom = $mainVersion . '/install.xml';
        $fileTo = Config::get('app', 'collection_folder') . $mainVersion . '/install.xml';

        FileSystem::copyFile($fileFrom, $fileTo);

        CLI::output('(' . $mainVersion . ') install.xml created!');
    }

    private static function copyInstallSQL($mainVersion)
    {
        $distributorVersion = InstallSQL::getInstallSQLDistributor($mainVersion);
        $fileFrom = $distributorVersion . '/install.sql';
        $fileTo = Config::get('app', 'collection_folder') . $mainVersion . '/install.sql';

        FileSystem::copyFile($fileFrom, $fileTo);

        CLI::output('(' . $mainVersion . ') install.sql created!');
    }

    private static function copyInstallPHP($mainVersion)
    {
        $distributorVersion = InstallPHP::getInstallPHPDistributor($mainVersion);
        $fileFrom = $distributorVersion . '/install.php';
        $fileTo = Config::get('app', 'collection_folder') . $mainVersion . '/install.php';

        FileSystem::copyFile($fileFrom, $fileTo);

        CLI::output('(' . $mainVersion . ') install.php created!');
    }

    private static function copyModuleFiles($mainVersion, $adminCatalogDir, $mvcDir, $file)
    {
        $structureDirFileToCopy = Structure::getPath($mainVersion, $adminCatalogDir, $mvcDir);

        $fileToCopy = $mainVersion . '/' . $structureDirFileToCopy . $file;

        $collectorFolder = Config::get('app', 'collection_folder');
        $newFile = $collectorFolder . $mainVersion . '/upload/' . $structureDirFileToCopy . $file;

        FileSystem::createDirByFile($newFile);
        FileSystem::copyFile($fileToCopy, $newFile);

        CLI::output("({$mainVersion}) {$adminCatalogDir} {$mvcDir} {$file} collected!");

        return $newFile;
    }

    private static function copyAdditionalFiles($mainVersion)
    {
        $additionalFiles = IntegratorAdditionalFiles::getRules();

        if ($additionalFiles && isset($additionalFiles[IntegratorAdditionalFiles::getKeyRulesByVersion($mainVersion)])) {

            foreach ($additionalFiles[IntegratorAdditionalFiles::getKeyRulesByVersion($mainVersion)] as $rules) {
                $distributeVersion = $rules[0];
                $fileFromTo = (gettype($rules[1]) == 'array') ? $rules[1] : [$rules[1], $rules[1]];
                $replaceRules = $rules[2] ?? null;

                $distributeFilePath = $distributeVersion . '/' . $fileFromTo[0];

                $collectorFolder = Config::get('app', 'collection_folder');
                $integrationFilePath = $collectorFolder . $mainVersion . '/upload/' . $fileFromTo[1];

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
<?php
use Controller\Helper\FileSystem;

//DISTRIBUTE TO ALL VERSIONS
$config = require_once __DIR__ . '/config.php';
$structureRule = require_once __DIR__ . '/rules/structure.php';
$filesToDistribute = require_once __DIR__ . '/files_to_distribute.php';

foreach ($filesToDistribute as $adminCatalogDirName => $adminCatalogDirs) {
    foreach ($adminCatalogDirs as $mvcDirName => $fileName) {

        foreach ($config['integration_versions'] as $integrationVersion) {

            $structureDirFileToCopy = $structureRule[$structureRule['conformity'][$config['distribution_version']]][$adminCatalogDirName][$mvcDirName];
            $fileToCopy = FileSystem::parentDir() . $config['distribution_version'] . '/' . $structureDirFileToCopy . $fileName;

            $structureDirNewFile = $structureRule[$structureRule['conformity'][$integrationVersion]][$adminCatalogDirName][$mvcDirName];
            $newFile = FileSystem::parentDir() . $integrationVersion . '/' . $structureDirNewFile . $fileName;
            FileSystem::createDirByFile($newFile);

            FileSystem::copyFile($fileToCopy, $newFile);
        }
    }
}
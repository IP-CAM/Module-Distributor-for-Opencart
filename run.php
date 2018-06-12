<?php

use Controller\Helper\FileSystem;

//DISTRIBUTE TO ALL VERSIONS
$config = require_once __DIR__ . '/config.php';
$structureAndConformity = require_once __DIR__ . '/rules/structureAndConformity.php';
$filesToDistribute = require_once __DIR__ . '/filesToDistribute.php';

foreach ($filesToDistribute as $adminCatalogDirName => $adminCatalogDirs) {
    foreach ($adminCatalogDirs as $mvcDirName => $files) {
        foreach ($files as $file) {
            foreach ($config['integration_versions'] as $integrationVersion) {

                $structureDirFileToCopy = $structureAndConformity[$structureAndConformity['conformity'][$config['distribution_version']]][$adminCatalogDirName][$mvcDirName];
                $fileToCopy = FileSystem::parentDir() . $config['distribution_version'] . '/' . $structureDirFileToCopy . $file;

                $structureDirNewFile = $structureAndConformity[$structureAndConformity['conformity'][$integrationVersion]][$adminCatalogDirName][$mvcDirName];
                $newFile = FileSystem::parentDir() . $integrationVersion . '/' . $structureDirNewFile . $file;
                FileSystem::createDirByFile($newFile);

                FileSystem::copyFile($fileToCopy, $newFile);
            }
        }
    }
}
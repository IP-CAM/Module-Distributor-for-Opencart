<?php

use Controller\Helper\FileSystem;
use Controller\Helper\CLI;

//DISTRIBUTE TO ALL VERSIONS
$config = require_once __DIR__ . '/config.php';
$structureAndConformity = require_once __DIR__ . '/rules/structureAndConformity.php';
$filesToDistribute = require_once __DIR__ . '/filesToDistribute.php';

foreach ($config['integration_versions'] as $integrationVersion) {
    foreach ($filesToDistribute as $adminCatalogDirName => $adminCatalogDirs) {
        foreach ($adminCatalogDirs as $mvcDirName => $files) {
            foreach ($files as $file) {
                $structureDirFileToCopy = $structureAndConformity[$structureAndConformity['conformity'][$config['distribution_version']]][$adminCatalogDirName][$mvcDirName];
                $fileToCopy = FileSystem::parentDir() . $config['distribution_version'] . '/' . $structureDirFileToCopy . $file;

                $structureDirNewFile = $structureAndConformity[$structureAndConformity['conformity'][$integrationVersion]][$adminCatalogDirName][$mvcDirName];
                $newFile = FileSystem::parentDir() . $integrationVersion . '/' . $structureDirNewFile . $file;
                FileSystem::createDirByFile($newFile);

                FileSystem::copyFile($fileToCopy, $newFile);

                CLI::output("({$integrationVersion}) $adminCatalogDirName $mvcDirName $file created!");
            }
        }
    }
}
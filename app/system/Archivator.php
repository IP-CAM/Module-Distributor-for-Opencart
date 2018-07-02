<?php
namespace App\System;

use App\Helper\UserString;
use App\Helper\FileSystem;
use App\Helper\Archivator as ArchivatorHelper;
use App\Helper\CLI;

Class Archivator
{
    public static function run()
    {
        $rules = self::getRules();
        $collectorRules = Collector::getRules();

        $basePath = Config::get('app', 'base_path_to_project');
        $modulePrefix = UserString::toCamelCase(Config::get('app', 'module_prefix'));
        $moduleName = UserString::toCamelCase(Config::get('app', 'module_name'));
        $moduleFullName = $modulePrefix . $moduleName;
        foreach ($rules as $distributeVersion => $distributeVersionName) {
            $filesDir = $basePath . $collectorRules['folder'] . $distributeVersion;
            $zipDir = $basePath . 'main/' . $moduleFullName . '/' . $distributeVersionName . '/';
            $zipName = $moduleFullName . '.ocmod.zip';

            FileSystem::createDir($zipDir);
            ArchivatorHelper::createFromFolder($filesDir, ['upload', 'install.xml', 'install.php', 'install.sql'], $zipDir, $zipName);

            CLI::output($zipName . ' created!');
        }

        ArchivatorHelper::createInSameFolder($basePath . 'main/', [$moduleFullName], $moduleFullName . '.zip');

        CLI::output($moduleFullName . '.zip created!');
    }

    public static function getRules()
    {
        return require __DIR__ . '/../../rules/archivator.php';
    }
}
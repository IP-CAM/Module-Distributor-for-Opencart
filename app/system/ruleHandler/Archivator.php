<?php
namespace App\System\RuleHandler;

use App\Helper\String;
use App\Helper\FileSystem;
use App\Helper\Archivator as ArchivatorHelper;
use App\Helper\CLI;
use App\System\Config;

Class Archivator
{
    public static function run()
    {
        $rules = self::getRules();
        $collectorRules = Collector::getRules();

        $basePath = Config::get('app', 'base_path_to_project');
        $modulePrefix = String::toCamelCase(Config::get('app', 'module_prefix'));
        $moduleName = String::toCamelCase(Config::get('app', 'module_name'));
        $moduleFullName = $modulePrefix . $moduleName;
        foreach ($rules as $distributeVersion => $distributeVersionName) {
            $files = $basePath . $collectorRules['folder'] . $distributeVersion;
            $zip = $basePath . 'main/' . $moduleFullName . '/' . $distributeVersionName . '/' . $moduleFullName . '.ocmod.zip';
            FileSystem::createDirByFile($zip);
            ArchivatorHelper::create($files, $zip);

            CLI::output($zip . ' created!');
        }

        ArchivatorHelper::createInSameFolder($basePath . 'main/' . $moduleFullName);

        CLI::output($moduleFullName . '.zip created!');
    }

    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/archivator.php';
    }
}
<?php
namespace App\System;

use App\Helper\UserString;
use App\Helper\FileSystem;
use App\Helper\Archivator as ArchivatorHelper;
use App\Helper\CLI;
use App\System\RuleHandler\Obfuscator as ObfuscatorRules;

Class Archivator
{
    public static function run()
    {
        $rules = Rule::get(Rule::ARCHIVATOR);
        $modulePrefix = UserString::toCamelCase(Config::get('app', 'module_prefix'));
        $moduleName = UserString::toCamelCase(Config::get('app', 'module_name'));
        $moduleFullName = $modulePrefix . $moduleName;
        foreach ($rules as $distributeVersion => $rule) {
            $filesDir = Config::get('app', 'collection_folder') . $distributeVersion;
            $zipDir = 'main/' . $moduleFullName . '/' . $rule['name'] . '/';
            $zipName = $moduleFullName . '.ocmod.zip';

            FileSystem::createDir($zipDir);
            ArchivatorHelper::createFromFolder($filesDir, ['upload', 'install.xml', 'install.php', 'install.sql'], $zipDir, $zipName);

            ArchivatorHelper::removePathFromArchive($zipDir . $zipName, '*' . ObfuscatorRules::$postfix);

            if (!$rule['is_upload_in_archive']) {
                ArchivatorHelper::removePathFromArchive($zipDir . $zipName, 'upload/admin/*');
                ArchivatorHelper::removePathFromArchive($zipDir . $zipName, 'upload/catalog/*');
                FileSystem::createDir($zipDir . '/upload/');
                FileSystem::copyDir($filesDir . '/upload/*', $zipDir . '/upload/');
            }

            CLI::output($zipName . ' created!');
        }

        ArchivatorHelper::createInSameFolder('main/', [$moduleFullName], $moduleFullName . '.zip');

        CLI::output($moduleFullName . '.zip created!');
    }
}
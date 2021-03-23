<?php
namespace App\Helper;

Class Archivator
{
    public static function create($path, $arch)
    {
        CLI::input("zip -r {$arch} {$path}");
    }

    /**
     * @param string $filesDir
     * @param array $files
     * @param string $archDir
     * @param string $archName
     */
    public static function createFromFolder($filesDir, $files, $archDir, $archName)
    {
        CLI::input("cd {$filesDir} && zip -r {$archName} " . implode(' ', $files) . " && mv {$archName} {$archDir}");
    }

    /**
     * @param string $filesDir
     * @param array $files
     * @param string $archName
     */
    public static function createInSameFolder($filesDir, $files, $archName)
    {
        CLI::input("cd {$filesDir} && zip -r {$archName} " . implode(' ', $files));
    }

    public static function removePathFromArchive($archName, $path)
    {
        CLI::input("zip --delete {$archName} \"{$path}\"");
    }
}
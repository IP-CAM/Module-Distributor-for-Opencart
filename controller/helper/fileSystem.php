<?php
namespace Controller\Helper;

Class FileSystem
{
    public static function createDir($dir)
    {
        $output = shell_exec('mkdir -p ' . $dir);
        return !$output;
    }

    public static function createDirByFile($file)
    {
        $fileToArray = explode('/', $file);
        array_pop($fileToArray);
        return self::createDir(implode('/', $fileToArray));
    }

    public static function copyFile($fileNameToCopy, $newFileName)
    {
        return copy($fileNameToCopy, $newFileName);
    }

    public static function parentDir()
    {
        return '../';
    }
}
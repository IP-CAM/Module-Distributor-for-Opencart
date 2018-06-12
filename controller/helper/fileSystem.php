<?php
namespace Controller\Helper;

Class FileSystem
{
    public static function createDir($dir)
    {
        if (!is_dir($dir)) {
            $output = shell_exec('mkdir -p ' . $dir);
            return !$output;
        } else {
            return true;
        }
    }

    public static function createDirByFile($file)
    {
        return self::createDir(dirname($file));
    }

    public static function copyFile($fileNameToCopy, $newFileName)
    {
        if (file_exists($fileNameToCopy)) {
            return copy($fileNameToCopy, $newFileName);
        } else {
            return false;
        }
    }

    public static function parentDir()
    {
        return '../';
    }
}
<?php
namespace App\Helper;

Class FileSystem
{
    public static function createDir($dir)
    {
        if (!is_dir($dir)) {
            $output = CLI::input('mkdir -p ' . $dir);
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

    public static function parentDir($level = 1)
    {
        return str_repeat('../', $level);
    }
}
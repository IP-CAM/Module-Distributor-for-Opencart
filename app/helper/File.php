<?php
namespace App\Helper;


use App\System\Config;

Class File
{
    public static function read($version, $file)
    {
        $configApp = Config::app();
        return file_get_contents($configApp['base_path_to_project'] . $version . '/' . $file);
    }

    public static function write($version, $file, $content)
    {
        $configApp = Config::app();
        return file_put_contents($configApp['base_path_to_project'] . $version . '/' . $file, $content);
    }
}
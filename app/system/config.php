<?php
namespace App\System;

Class Config
{
    public static function app()
    {
        return require __DIR__ . '/../../config/app.php';
    }

    public static function filesToDistribute()
    {
        return require __DIR__ . '/../../config/files_to_distribute.php';
    }

    public static function get($type, $configName)
    {
            $config = self::$type();
            return $config[$configName];
    }
}
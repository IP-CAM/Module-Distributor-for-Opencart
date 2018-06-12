<?php
namespace App\System;

Class Config
{
    public static function app()
    {
        return require_once __DIR__ . '/../../config/app.php';
    }

    public static function filesToDistribute()
    {
        return require_once __DIR__ . '/../../config/filesToDistribute.php';
    }

    public static function get($type, $configName)
    {
            $config = self::$type();
            return $config[$configName];
    }
}
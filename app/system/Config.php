<?php
namespace App\System;

Class Config
{
    public static function app()
    {
        return require __DIR__ . '/../../config/app.php';
    }

    public static function get($type, $configName)
    {
            $config = self::$type();
            return $config[$configName];
    }
}
<?php
namespace App\System;

Class Config
{
    public static function app()
    {
        $path = __DIR__ . '/../../../distributor_config.php';
        if (!file_exists($path)) {
            throw new \Exception('distributor_config.php Not Found!');
        }
        return require $path;
    }

    public static function get($type, $configName)
    {
            $config = self::$type();
            return $config[$configName];
    }
}
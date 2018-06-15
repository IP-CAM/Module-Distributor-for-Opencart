<?php
namespace App\Helper;

Class String
{
    public static function toCamelCase($name)
    {
        return str_replace('_', '', ucwords($name, '_'));
    }
}

<?php
namespace App\Helper;

Class UserString
{
    public static function toCamelCase($name)
    {
        return str_replace('_', '', ucwords($name, '_'));
    }
}

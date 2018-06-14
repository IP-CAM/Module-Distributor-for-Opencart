<?php
namespace App\Helper;

use App\System\Config;

Class Replacer
{
    public static function replaceInFile($search, $replace, $file) {
        if (file_exists($file)) {
            $content = file_get_contents($file);

            self::replaceShortCodes($search);
            self::replaceShortCodes($replace);

            $newContent = str_replace($search, $replace, $content);

            file_put_contents($file, $newContent);
        }
    }

    private static function replaceShortCodes(&$string)
    {
        $string = str_replace('{module_name}', Config::get('app', 'module_name'), $string);

        $className = str_replace('_', '', ucwords(Config::get('app', 'module_name'), '_'));
        $string = str_replace('{class_name}', $className, $string);
    }
}
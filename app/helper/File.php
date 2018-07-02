<?php
namespace App\Helper;


use App\System\Config;

Class File
{
    public static function read($file, $version = false)
    {
        $configApp = Config::app();
        $dirRoot = '';
        if ($version) {
            $dirRoot = $configApp['base_path_to_project'] . $version . '/';
        }
        return file_get_contents($dirRoot . $file);
    }

    public static function write($file, $content, $version = false)
    {
        $configApp = Config::app();
        $dirRoot = '';
        if ($version) {
            $dirRoot = $configApp['base_path_to_project'] . $version . '/';
        }
        return file_put_contents($dirRoot . $file, $content);
    }

    public static function replaceText($search, $replace, $file) {
        if (file_exists($file)) {
            $content = self::read($file);

            self::multiLinesToOneLine($content);
            self::multiLinesToOneLine($search);
            self::multiLinesToOneLine($replace);

            self::replaceShortCodes($search);
            self::replaceShortCodes($replace);

            $newContent = str_replace($search, $replace, $content);

            self::oneLineToMultiLines($newContent);

            self::write($file, $newContent);
        }
    }

    private static function replaceShortCodes(&$string)
    {
        $string = str_replace('{module_name}', Config::get('app', 'module_name'), $string);

        $className = UserString::toCamelCase(Config::get('app', 'module_name'));
        $string = str_replace('{class_name}', $className, $string);
    }

    private static function oneLineToMultiLines(&$string)
    {
        $string = str_replace(['#NEW_LINE#', '#RETURN#'], ["\n", "\r"], $string);
        return $string;
    }

    private static function multiLinesToOneLine(&$content)
    {
        $content = str_replace(["\n", "\r"], ['#NEW_LINE#', '#RETURN#'], $content);
        return $content;
    }
}
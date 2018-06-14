<?php
namespace App\Helper;

Class Replacer
{
    public static function replaceInFile($search, $replace, $file) {
        if (file_exists($file)) {
            $content = file_get_contents($file);
            $newContent = str_replace($search, $replace, $content);

            file_put_contents($file, $newContent);
        }
    }
}
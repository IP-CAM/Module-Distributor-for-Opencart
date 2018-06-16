<?php
namespace App\Helper;

Class Archivator
{
    public static function create($path, $arch)
    {
        shell_exec("zip -r {$arch} {$path}");
    }

    public static function createInSameFolder($path)
    {
        shell_exec("zip -r {$path}.zip {$path}");
    }
}
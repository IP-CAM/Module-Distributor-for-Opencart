<?php
namespace App\System\Rules;

Class Copy
{
    public static function getRules()
    {
        return require_once __DIR__ . '/../../../rules/copy.php';
    }
}
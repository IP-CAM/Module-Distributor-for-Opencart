<?php
namespace App\Helper;

Class CLI
{
    public static function input($input)
    {
        return shell_exec($input);
    }

    public static function output($output)
    {
        echo $output . "\n";
    }
}
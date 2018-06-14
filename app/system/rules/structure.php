<?php
namespace App\System\Rules;

Class Structure extends Integrator
{
    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/structure.php';
    }
}
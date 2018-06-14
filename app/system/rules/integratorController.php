<?php
namespace App\System\Rules;

Class IntegratorController extends Integrator
{
    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/controller.php';
    }
}
<?php
namespace App\System\Rules;

Class IntegratorModel extends Integrator
{
    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/model.php';
    }
}
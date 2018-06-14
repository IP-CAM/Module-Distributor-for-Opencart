<?php
namespace App\System\Rules;

Class IntegratorView extends Integrator
{
    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/view.php';
    }
}
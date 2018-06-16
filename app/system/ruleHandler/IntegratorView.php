<?php
namespace App\System\RuleHandler;

Class IntegratorView extends Integrator
{
    protected static $storageConformity = null;

    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/view.php';
    }
}
<?php
namespace App\System\RuleHandler;

Class IntegratorController extends Integrator
{
    protected static $storageConformity = null;

    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/controller.php';
    }
}
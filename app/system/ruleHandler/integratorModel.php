<?php
namespace App\System\RuleHandler;

Class IntegratorModel extends Integrator
{
    protected static $storageConformity = null;

    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/model.php';
    }
}
<?php

namespace App\System\RuleHandler;

Class Obfuscator extends Integrator
{
    public static $postfix = '.original';

    protected static $storageConformity = null;

    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/obfuscator.php';
    }
}
<?php

namespace App\System\RuleHandler;

use App\system\Rule;

Class Obfuscator extends Integrator
{
    public static $postfix = '.original';

    protected static $storageConformity = null;

    public static function getRules()
    {
        return Rule::get(Rule::OBFUSCATOR);
    }
}
<?php
namespace App\System\RuleHandler;

use App\system\Rule;

Class IntegratorView extends Integrator
{
    protected static $storageConformity = null;

    public static function getRules()
    {
        return Rule::get(Rule::VIEW);
    }
}
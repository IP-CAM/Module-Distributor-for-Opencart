<?php
namespace App\System\RuleHandler;

use App\system\Rule;

Class IntegratorModel extends Integrator
{
    protected static $storageConformity = null;

    public static function getRules()
    {
        return Rule::get(Rule::MODEL);
    }
}
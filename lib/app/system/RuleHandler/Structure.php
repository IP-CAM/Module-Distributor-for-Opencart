<?php
namespace App\System\RuleHandler;

use App\system\Rule;

Class Structure extends Integrator
{
    protected static $storageConformity = null;

    public static function getPath($version, $catalogAdminDir, $mvcDir)
    {
        $rules = static::getRules();
        return $rules[static::getKeyRulesByVersion($version)][$catalogAdminDir][$mvcDir] ?? null;
    }

    public static function getRules()
    {
        return Rule::get(Rule::STRUCTURE);
    }
}
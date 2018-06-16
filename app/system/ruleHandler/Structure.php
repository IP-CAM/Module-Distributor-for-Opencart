<?php
namespace App\System\RuleHandler;

Class Structure extends Integrator
{
    protected static $storageConformity = null;

    public static function getPath($version, $catalogAdminDir, $mvcDir)
    {
        $rules = static::getRules();
        return $rules[static::getKeyRulesByVersion($version)][$catalogAdminDir][$mvcDir];
    }

    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/structure.php';
    }
}
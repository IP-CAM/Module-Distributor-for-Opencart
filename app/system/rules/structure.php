<?php
namespace App\System\Rules;

Class Structure extends Integrator
{
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
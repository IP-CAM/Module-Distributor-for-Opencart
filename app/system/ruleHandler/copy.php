<?php
namespace App\System\RuleHandler;

use App\Helper\Interpretation;

Class Copy
{
    public static function getDistributeVersion($integrationVersion, $mvcDir)
    {
        $rules = self::getRules();

        foreach ($rules[$mvcDir] as $distributeVersion => $conformity) {
            if (in_array($integrationVersion, Interpretation::rangeToArray($conformity))) {
                return (string)$distributeVersion;
            }
        }

        new \Exception('Do not much integration version');
        return false;
    }

    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/copy.php';
    }
}
<?php
namespace App\System\Rules;

use App\Helper\Interpretation;

Class Format
{
    public static function getFormat($integrationVersion, $mvcDir)
    {
        $rules = self::getRules();

        foreach ($rules[$mvcDir] as $distributeVersion => $conformity) {
            if (in_array($integrationVersion, Interpretation::rangeToArray($conformity))) {
                return $distributeVersion;
            }
        }

        new \Exception('Do not much integration version');
        return false;
    }

    public static function getRules()
    {
        return require_once __DIR__ . '/../../../rules/format.php';
    }
}
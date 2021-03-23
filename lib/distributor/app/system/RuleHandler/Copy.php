<?php
namespace App\System\RuleHandler;

use App\Helper\Interpretation;
use App\system\Rule;

Class Copy
{
    public static function getDistributeVersion($integrationVersion, $mvcDir)
    {
        $rules = Rule::get(Rule::COPY);
        foreach ($rules[$mvcDir] as $distributeVersion => $conformity) {
            if (in_array($integrationVersion, Interpretation::rangeToArray($conformity))) {
                return (string)$distributeVersion;
            }
        }

        new \Exception('Do not much integration version');
        return false;
    }
}
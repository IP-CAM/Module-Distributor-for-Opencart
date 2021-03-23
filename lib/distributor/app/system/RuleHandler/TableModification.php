<?php
namespace App\System\RuleHandler;

use App\system\Rule;

Class TableModification extends Integrator
{
    public static function getRules()
    {
        return Rule::get(Rule::TABLE_MODIFICATION);
    }
}
<?php
namespace App\System\RuleHandler;

Class TableModification extends Integrator
{
    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/table_modification.php';
    }
}
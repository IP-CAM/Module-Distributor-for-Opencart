<?php
namespace App\System\RuleHandler;

use App\system\Rule;

Class FilesToDistribute
{
    public static function getRules()
    {
        return Rule::get(Rule::FILES_TO_DISTRIBUTE);
    }

    public static function getModuleFiles()
    {
        $rules = static::getRules();
        return $rules['module'];
    }

    public static function getOCModFiles()
    {
        $rules = static::getRules();
        return $rules['oc_modification'];
    }

    public static function getAdditionalFiles()
    {
        $rules = static::getRules();
        return $rules['additional_files'];
    }
}
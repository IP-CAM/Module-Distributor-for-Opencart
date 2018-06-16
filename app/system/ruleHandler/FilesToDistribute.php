<?php
namespace App\System\RuleHandler;

Class FilesToDistribute
{
    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/files_to_distribute.php';
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
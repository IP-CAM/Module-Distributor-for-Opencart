<?php
namespace App\System\Rules;

Class Integrator
{
    public static function conformity(){return [];}

    public static function integrateToVersion($integrationVersion, $adminCatalogDirName, $file)
    {
        $rules = static::getRules();

        if (!empty($rules[static::getKeyRulesByVersion($integrationVersion)][$adminCatalogDirName])) {
            foreach ($rules[static::getKeyRulesByVersion($integrationVersion)][$adminCatalogDirName] as $rule) {
                str_replace($rule[0], $rule[1], $file);
            }
        }
    }

    /**
     * @return array
     */
    public static function getRules(){return [];}

    /**
     * @var string $version
     * @return string
     */
    public static function getKeyRulesByVersion($version)
    {
        $conformity = static::conformity();
        return $conformity[$version];
    }
}
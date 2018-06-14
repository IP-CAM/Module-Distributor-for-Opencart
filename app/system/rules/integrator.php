<?php
namespace App\System\Rules;

use App\Helper\Interpretation;
use App\Helper\Replacer;

Class Integrator
{
    protected static $storageConformity = null;

    public static function conformity() {
        if (static::$storageConformity == null) {
            $rules = static::getRules();

            foreach ($rules as $keyRules => $rule) {
                $arrayKeyRules = Interpretation::rangeToArray($keyRules);

                foreach ($arrayKeyRules as $arrayKeyRule) {
                    static::$storageConformity[$arrayKeyRule] = $keyRules;
                }
            }
        }
        return static::$storageConformity;
    }

    public static function integrateToVersion($integrationVersion, $adminCatalogDirName, $file)
    {
        $rules = static::getRules();

        if (!empty($rules[static::getKeyRulesByVersion($integrationVersion)][$adminCatalogDirName])) {
            foreach ($rules[static::getKeyRulesByVersion($integrationVersion)][$adminCatalogDirName] as $rule) {
                Replacer::replaceInFile($rule[0], $rule[1], $file);
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
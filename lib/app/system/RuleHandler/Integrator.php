<?php
namespace App\System\RuleHandler;

use App\Helper\CLI;
use App\Helper\Interpretation;
use App\Helper\File;

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

    public static function integrateToVersion($integrationVersion, $adminCatalogDir, $file)
    {
        $rules = static::getRules();

        if (!empty($rules[static::getKeyRulesByVersion($integrationVersion)][$adminCatalogDir])) {
            foreach ($rules[static::getKeyRulesByVersion($integrationVersion)][$adminCatalogDir] as $rule) {
                File::replaceText($rule[0], $rule[1], $file);
                CLI::output("{$file} replaced: {$rule[0]} => $rule[1]");
            }
        }
    }


    public static function getRules(){return [];}

    /**
     * @var string $version
     * @return string
     */
    public static function getKeyRulesByVersion($version)
    {
        $conformity = static::conformity();
        if (isset($conformity[$version])) {
            return $conformity[$version];
        } else {
            return false;
        }
    }
}
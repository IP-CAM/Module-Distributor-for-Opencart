<?php
namespace App\System\RuleHandler;

use App\Helper\Interpretation;
use App\system\Rule;

Class Format
{
    public static function makeFormatIfNotExists($integrationVersion, $mvcDir, $file)
    {
        $currentFormat = pathinfo($file,PATHINFO_EXTENSION);

        if (empty($currentFormat)) {
            $rules = Rule::get(Rule::FORMAT);
            foreach ($rules[$mvcDir] as $versions => $format) {
                $arr = Interpretation::rangeToArray($versions);
                if (in_array($integrationVersion, $arr)) {
                    return "{$format}";
                }
            }
        }

        return null;
    }
}
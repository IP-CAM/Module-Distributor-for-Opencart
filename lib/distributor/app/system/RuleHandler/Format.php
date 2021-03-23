<?php
namespace App\System\RuleHandler;

use App\Helper\Interpretation;
use App\system\Rule;

Class Format
{
    public static function addFormatToFileIfNotExists($integrationVersion, $mvcDir, &$file)
    {
        $currentFormat = pathinfo($file,PATHINFO_EXTENSION);

        if (empty($currentFormat)) {
            $rules = Rule::get(Rule::FORMAT);
            foreach ($rules[$mvcDir] as $versions => $format) {
                $arr = Interpretation::rangeToArray($versions);
                if (in_array($integrationVersion, $arr)) {
                    $file .= $format;
                    break;
                }
            }
        }

        return $file;
    }
}
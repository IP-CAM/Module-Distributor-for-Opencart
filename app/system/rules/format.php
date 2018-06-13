<?php
namespace App\System\Rules;

use App\Helper\Interpretation;

Class Format
{
    public static function addFormatToFileIfNotExists($integrationVersion, $mvcDir, &$file)
    {
        $currentFormat = pathinfo($file,PATHINFO_EXTENSION);

        if (empty($currentFormat)) {
            $rules = self::getRules();

            foreach ($rules[$mvcDir] as $versions => $format) {
                if (in_array($integrationVersion, Interpretation::rangeToArray($versions))) {
                    $file .= $format;
                    break;
                }
            }
        }

        return $file;
    }

    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/format.php';
    }
}
<?php
namespace App\Helper;

use App\System\Config;

Class Interpretation
{
    /**
     * @param string $range - is format 'xxxx:xxxx' or 'all'
     * @return array
     */
    public static function rangeToArray($range) {
        if ($range == 'all') {
            $allVersions = Config::get('app', 'integration_versions');
            array_unshift($allVersions, Config::get('app', 'distribution_version'));
            return $allVersions;
        }

        $rangeToArray = explode(':', $range);
        if (count($rangeToArray) > 1) {
            $rangeToArray = range($rangeToArray[0], $rangeToArray[1]);
        }

        foreach ($rangeToArray as &$item) {
            $item = (string)$item;
        }

        return $rangeToArray;
    }
}
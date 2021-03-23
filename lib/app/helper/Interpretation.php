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
            return Config::get('app', 'integration_versions');
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

    public static function inRange($range, $version) {
        return in_array($version, self::rangeToArray($range));
    }
}
<?php
namespace App\Helper;

use App\System\Config;

Class Helper
{
    /**
     * @param string $range - is format 'xxxx:xxxx' or 'all'
     * @return array
     */
    public static function rangeToArray($range) {
        if ($range == 'all') {
            return Config::get('app', 'integration_versions');
        }
    }
}
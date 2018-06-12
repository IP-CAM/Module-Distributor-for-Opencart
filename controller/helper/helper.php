<?php
namespace Controller\Helper;

Class Helper
{
    /**
     * @param string $range - is format 'xxxx:xxxx' or 'all'
     * @return array
     */
    public static function rangeToArray($range) {
        if ($range == 'all') {
            $config = require __DIR__ . '/../../config.php';
            return $config['integration_versions'];
        }
    }
}
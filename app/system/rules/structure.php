<?php
namespace App\System\Rules;

Class Structure
{
    private static $conformity = [
        '2010' => '2010:2102',
        '2011' => '2010:2102',
        '2020' => '2010:2102',
        '2031' => '2010:2102',
        '2101' => '2010:2102',
        '2102' => '2010:2102',

        '2200' => '2200',

        '2300' => '2300:3020',
        '2301' => '2300:3020',
        '2302' => '2300:3020',
        '3000' => '2300:3020',
        '3011' => '2300:3020',
        '3012' => '2300:3020',
        '3020' => '2300:3020',
    ];

    public static function conformity($version)
    {
        return self::$conformity[$version];
    }

    public static function getRules()
    {
        return require_once __DIR__ . '/../../../rules/structure.php';
    }
}
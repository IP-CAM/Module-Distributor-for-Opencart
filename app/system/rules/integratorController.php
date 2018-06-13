<?php
namespace App\System\Rules;

Class IntegratorController extends Integrator
{
    public static function conformity()
    {
        return [
            '2010' => '2010:2102',
            '2011' => '2010:2102',
            '2020' => '2010:2102',
            '2031' => '2010:2102',
            '2101' => '2010:2102',
            '2102' => '2010:2102',

            '2200' => '2200',

            '2300' => '2300:2302',
            '2301' => '2300:2302',
            '2302' => '2300:2302',

            '3000' => '3000:3020',
            '3011' => '3000:3020',
            '3012' => '3000:3020',
            '3020' => '3000:3020',
        ];
    }

    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/controller.php';
    }
}
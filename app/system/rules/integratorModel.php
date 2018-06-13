<?php
namespace App\System\Rules;

Class IntegratorModel extends Integrator
{
    public static function conformity()
    {
        return [
            '2010' => '2010:2200',
            '2011' => '2010:2200',
            '2020' => '2010:2200',
            '2031' => '2010:2200',
            '2101' => '2010:2200',
            '2102' => '2010:2200',
            '2200' => '2010:2200',

            '2300' => '2300:3020',
            '2301' => '2300:3020',
            '2302' => '2300:3020',
            '3000' => '2300:3020',
            '3011' => '2300:3020',
            '3012' => '2300:3020',
            '3020' => '2300:3020',
        ];
    }

    public static function getRules()
    {
        return require __DIR__ . '/../../../rules/model.php';
    }
}
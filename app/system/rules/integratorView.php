<?php
namespace App\System\Rules;

Class IntegratorView extends Integrator
{
    public static function conformity()
    {
        return [
            '2010' => '2010:2302',
            '2011' => '2010:2302',
            '2020' => '2010:2302',
            '2031' => '2010:2302',
            '2101' => '2010:2302',
            '2102' => '2010:2302',
            '2200' => '2010:2302',
            '2300' => '2010:2302',
            '2301' => '2010:2302',
            '2302' => '2010:2302',

            '3000' => '3000:3020',
            '3011' => '3000:3020',
            '3012' => '3000:3020',
            '3020' => '3000:3020',
        ];
    }

    public static function getRules()
    {
        return require_once __DIR__ . '/../../../rules/view.php';
    }
}
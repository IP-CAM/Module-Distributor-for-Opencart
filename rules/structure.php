<?php
return [
    'common' => [
        'admin' => [
            'css' => 'admin/view/stylesheet/',
            'js' => 'admin/view/javascript/',
        ],

        'catalog' => [
            'css' => 'catalog/view/stylesheet/',
            'js' => 'catalog/view/theme/default/javascript/',
        ]
    ],

    'conformity' => [
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
    ],

    '2010:2102' => [
        'admin' => [
            'controller' => 'admin/controller/module/',
            'model' => 'admin/model/module/',
            'view' => 'admin/view/template/module/',
            'language' => [
                'ru' => 'admin/language/russian/module/',
                'en' => 'admin/language/english/module/',
            ],
        ],

        'catalog' => [
            'controller' => 'catalog/controller/module/',
            'model' => 'catalog/model/module/',
            'view' => 'catalog/view/theme/default/template/module/',
            'language' => [
                'ru' => 'catalog/language/russian/module/',
                'en' => 'catalog/language/english/module/',
            ],
        ]
    ],

    '2200' => [
        'admin' => [
            'controller' => 'admin/controller/module/',
            'model' => 'admin/model/module/',
            'view' => 'admin/view/template/module/',
            'language' => [
                'ru' => 'admin/language/ru-ru/module/',
                'en' => 'admin/language/en-gb/module/',
            ],
        ],

        'catalog' => [
            'controller' => 'catalog/controller/module/',
            'model' => 'catalog/model/module/',
            'view' => 'catalog/view/theme/default/template/module/',
            'language' => [
                'ru' => 'catalog/language/ru-ru/module/',
                'en' => 'catalog/language/en-gb/module/',
            ],
        ]
    ],

    '2300:3020' => [
        'admin' => [
            'controller' => 'admin/controller/extension/module/',
            'model' => 'admin/model/extension/module/',
            'view' => 'admin/view/template/extension/module/',
            'language' => [
                'ru' => 'admin/language/ru-ru/extension/module/',
                'en' => 'admin/language/en-gb/extension/module/',
            ],
        ],

        'catalog' => [
            'controller' => 'catalog/controller/extension/module/',
            'model' => 'catalog/model/extension/module/',
            'view' => 'catalog/view/theme/default/template/extension/module/',
            'language' => [
                'ru' => 'catalog/language/ru-ru/extension/module/',
                'en' => 'catalog/language/en-gb/extension/module/',
            ],
        ]
    ]
];
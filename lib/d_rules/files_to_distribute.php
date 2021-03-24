<?php

/**
 * If format do not specify, its will create automate from format rules
 */

return [
    'module' => [
        'admin' => [
            'controller' => [
                'awesome.php',
            ],
            'model' => [
                //'awesome.php',
            ],
            'view' => [
                'awesome', //Without format
            ],
            'css' => [
                'awesome.css'
            ],
            'js' => [
                'awesome.js'
            ],
            'language_ru' => [
                'awesome.php',
            ],
            'language_en' => [
                'awesome.php',
            ]
        ],

        'catalog' => [
            'controller' => [
                'awesome.php',
            ],
            'model' => [
                'awesome.php',
            ],
            'view' => [
                'awesome', //Without format
            ],
            'css' => [
                'awesome.css'
            ],
            'js' => [
                'awesome.js'
            ],
            'language_ru' => [
                'awesome.php',
            ],
            'language_en' => [
                'awesome.php',
            ],
        ]
    ],

    'additional_files' => [
        'all' => [
            [
                //Distribute from version
                '2010',

                //File from -> to string or array ['from' => 'to']
                'system/library/product.php',

                //Optional!
                //Replace rules [['search', 'replace']]
//                [
//                    [
//                        'search', 'replace'
//                    ]
//                ]
            ]
        ],
    ],
];
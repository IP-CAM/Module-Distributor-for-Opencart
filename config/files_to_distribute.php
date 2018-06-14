<?php

/**
 * If format do not specify, its will create automate from format rules
 */

return [
    'module' => [
        'admin' => [
            'controller' => [
                'same_category_products.php',
            ],
            'view' => [
                'same_category_products',
            ],
            'css' => [
                'same_category_products.css'
            ],
            'js' => [
                'same_category_products.js'
            ],
            'language_ru' => [
                'same_category_products.php',
            ],
            'language_en' => [
                'same_category_products.php',
            ]
        ],

        'catalog' => [
            'controller' => [
                'same_category_products.php',
            ],
            'model' => [
                'same_category_products.php',
            ],
            'view' => [
                'same_category_products',
            ],
            'css' => [
                'same_category_products.css'
            ],
            'js' => [
                'same_category_products.js'
            ],
            'language_ru' => [
                'same_category_products.php',
            ],
            'language_en' => [
                'same_category_products.php',
            ],
        ]
    ],

    'oc_modification' => [
        [
            '2010' => '2010:2200', //From distributor to integration
            'admin/controller/catalog/category.php'
        ]
    ],
];
<?php
/**
 * Short codes:
 * {module_name}
 * {class_name}
 */

return [
    '2010:2302' => [
        'admin' => [],
        'catalog' => []
    ],

    '3000:3020' => [
        'admin' => [
            [
                '[regex]<\?php echo \$(.*); \?>',
                '{{ ${1} }}'
            ]
        ],
        'catalog' => [
            [
                '[regex]<\?php echo \$(.*); \?>',
                '{{ ${1} }}'
            ]
        ]
    ]
];
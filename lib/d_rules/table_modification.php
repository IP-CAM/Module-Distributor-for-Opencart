<?php
$name = \App\System\Config::get('app', 'module_name');
$author = \App\System\Config::get('app', 'author');
$version = \App\System\Config::get('app', 'version');
$link = \App\System\Config::get('app', 'site');
$date_added = date('Y-m-d H:i:s');

return [
    '2000' => [
        'name' => $name,
        'author' => $author,
        'version' => $version,
        'link' => $link,
        'code' => '{xml}',
        'status' => 1,
        'date_added' => $date_added,
    ],

    '2010:2302' => [
        'name' => $name,
        'code' => $name,
        'author' => $author,
        'version' => $version,
        'link' => $link,
        'xml' => '{xml}',
        'status' => 1,
        'date_added' => $date_added,
    ],

    '3000:3020' => [
        'extension_install_id' => 0,
        'name' => $name,
        'code' => $name,
        'author' => $author,
        'version' => $version,
        'link' => $link,
        'xml' => '{xml}',
        'status' => 1,
        'date_added' => $date_added,
    ]
];
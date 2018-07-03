<?php

return [
    'module_name' => 'digital_elephant_filter',
    'module_prefix' => '',
    'base_path_to_project' => '/media/sf_www/digital-elephant/filter/',
    'distribution_version' => '2000',
    'integration_versions' => ['2010', '2011', '2020', '2031', '2101', '2102', '2200', '2302', '3000', '3011', '3012', '3020'],
//    'integration_versions' => ['2010', '2011', '2020', '2031', '2101', '2102', '2200', '2302'],

    'db' => [
      'hostname' => 'localhost',
      'username' => 'denis',
      'password'  => '111den123',
      'database_prefix'  => 'ocfilter_',
      'table_prefix' => 'oc_'
    ]
//    'integration_versions' => ['2302']
];

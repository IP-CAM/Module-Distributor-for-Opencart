<?php
$loader = require __DIR__ . '/vendor/autoload.php';
use App\Controller;

if (!file_exists('distributor_config.php') || !is_dir('d_rules')) {
    throw new Exception('Not found config files. You can create this by command - [oc-dist-deploy] ');
}

Controller::run();
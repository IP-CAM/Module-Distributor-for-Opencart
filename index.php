<?php
$loader = require __DIR__ . '/vendor/autoload.php';
$loader->addPsr4('Controller\\', __DIR__ . '/controller');

require_once __DIR__ . '/run.php';

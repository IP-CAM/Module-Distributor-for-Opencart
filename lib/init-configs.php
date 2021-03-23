<?php
$loader = require __DIR__ . '/vendor/autoload.php';
$distributorConfigPath = __DIR__ . '/../distributor_config.php';
$rulesDirPath = __DIR__ . '/../d_rules';

if (file_exists($distributorConfigPath)) {
    \App\Helper\CLI::output('~ File distributor_config.php already exists!');
} else {
    copy(__DIR__ . '/distributor_config.php.stub', $distributorConfigPath);
    \App\Helper\CLI::output('+ File distributor_config.php is copied!');
}

if (!is_dir($rulesDirPath)) {
    mkdir($rulesDirPath, 0777);
    \App\Helper\CLI::output('+ Dir d_rules is created!');
}

foreach (\App\system\Rule::allNames() as $rule) {
    $path = $rulesDirPath . "/{$rule}.php";
    if (file_exists($path)) {
        \App\Helper\CLI::output("~ File {$rule}.php is exists!");
    } else {
        copy(__DIR__ . "/d_rules/{$rule}.php.stub", $path);
        \App\Helper\CLI::output("+ File {$rule}.php is copied!");
    }
}
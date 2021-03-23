<?php
namespace App\System;

use App\System\RuleHandler\IntegratorAdditionalFiles;
use App\Helper\CLI;

Class AdditionalFiles
{
    public static function run()
    {
        $configApp = Config::app();

        //Distribute additional_files to other project versions
        foreach ($configApp['integration_versions'] as $integrationVersion) {
            IntegratorAdditionalFiles::distribute($integrationVersion);
            CLI::output('OC Additional file ' . $integrationVersion . ' apply!');
        }
    }
}
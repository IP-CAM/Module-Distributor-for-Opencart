<?php

namespace App;

use App\System\Collector;
use App\System\Archivator;
use App\System\Obfuscator;
use App\System\RuleHandler\InstallXML;
use App\System\Distributor;
use App\System\AdditionalFiles;



Class Controller
{
    public static function run() {
        Distributor::run();
        AdditionalFiles::run();
        InstallXML::applyModifications();

        Collector::run();
        Obfuscator::run();
        Archivator::run();
    }
}
<?php


namespace App\system;


class Rule
{
    const ARCHIVATOR = 'archivator';
    const COLLECTOR = 'collector';
    const CONTROLLER = 'controller';
    const COPY = 'copy';
    const FILES_TO_DISTRIBUTE = 'files_to_distribute';
    const FORMAT = 'format';
    const INSTALL_PHP = 'install_php';
    const INSTALL_SQL = 'install_sql';
    const INSTALL_XML = 'install_xml';
    const MODEL = 'model';
    const OBFUSCATOR = 'obfuscator';
    const STRUCTURE = 'structure';
    const TABLE_MODIFICATION = 'table_modification';
    const VIEW = 'view';


    public static function get($name)
    {
        if (!in_array($name, self::allNames())) {
            throw new \Exception('Rule::get() Not Available Name!');
        }

        $path = __DIR__ . "/../../../../d_rules/{$name}.php";
        if (!file_exists($path)) {
            throw new \Exception("Rule::get() [d_rules/{$name}.php] file is not exists!");
        }

        return require $path;
    }

    public static function allNames()
    {
        return [
            self::ARCHIVATOR,
            self::COLLECTOR,
            self::CONTROLLER,
            self::COPY,
            self::FILES_TO_DISTRIBUTE,
            self::FORMAT,
            self::INSTALL_PHP,
            self::INSTALL_SQL,
            self::INSTALL_XML,
            self::MODEL,
            self::OBFUSCATOR,
            self::STRUCTURE,
            self::TABLE_MODIFICATION,
            self::VIEW
        ];
    }
}
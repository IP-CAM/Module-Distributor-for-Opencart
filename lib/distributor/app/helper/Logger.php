<?php
namespace App\Helper;

use App\System\Config;


Class Logger
{
    private $file = '';

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function write($log)
    {
        $date = date('Y-m-d H:i:s');

        file_put_contents(
            Config::get('app', 'base_path_to_project') . 'distributor/logs/' . $this->file,
            $date . "\n" . print_r($log, true)
        );
    }
}
<?php
use PHPUnit\Framework\TestCase;
use App\System\Rules\Format;

class FormatTest extends TestCase
{
    /**
     * @dataProvider additionalProvider
     */
    public function testAddFormatToFileIfNotExists($integrationVersion, $mvcDir, $file, $expected)
    {
        $this->assertSame($expected, Format::addFormatToFileIfNotExists($integrationVersion, $mvcDir, $file));
    }

    public function additionalProvider()
    {
        return [
            ['2010', 'controller',  'file_name',        'file_name.php'],
            ['2010', 'controller',  'file_name.php',    'file_name.php'],
            ['2010', 'view',        'file_name',        'file_name.tpl'],
            ['3000', 'view',        'file_name',        'file_name.twig'],
            ['3000', 'view',        'file_name.tpl',    'file_name.tpl'],
        ];
    }
}
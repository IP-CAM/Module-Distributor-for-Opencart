<?php
use PHPUnit\Framework\TestCase;
use App\System\Rules\Copy;

class CopyTest extends TestCase
{
    /**
     * @dataProvider additionalProvider
     */
    public function testGetDistributeVersion($integrationVersion, $mvcDir, $expected)
    {
        $this->assertSame($expected, Copy::getDistributeVersion($integrationVersion, $mvcDir));
    }

    public function additionalProvider()
    {
        return [
            ['2020', 'controller', '2010'],
            ['2010', 'view', '2010:2302'],
            ['2020', 'view', '2010:2302'],
            ['2302', 'view', '2010:2302'],
            ['3000', 'view', '3000:3020'],
            ['3011', 'view', '3000:3020'],
            ['3020', 'view', '3000:3020'],
        ];
    }
}
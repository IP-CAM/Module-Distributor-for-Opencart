<?php
use PHPUnit\Framework\TestCase;
use App\System\Rules\Structure;

class StructureTest extends TestCase
{
    /**
     * @dataProvider additionalProvider
     */
    public function testGetKeyRulesByVersion($version, $expected)
    {
        $this->assertSame($expected, Structure::getKeyRulesByVersion($version));
    }

    public function additionalProvider()
    {
        return [
            ['2010', '2010:2102'],
            ['2020', '2010:2102'],
            ['2102', '2010:2102'],
            ['3000', '2300:3020'],
            ['3011', '2300:3020'],
            ['3020', '2300:3020'],
        ];
    }
}
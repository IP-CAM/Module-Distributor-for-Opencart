<?php
use PHPUnit\Framework\TestCase;
use App\Helper\Interpretation;
use App\System\Config;

class InterpretationTest extends TestCase
{
    /**
     * @dataProvider additionalProvider
     */
    public function testRangeToArray($actual, $expected)
    {
        $this->assertSame($expected, Interpretation::rangeToArray($actual));
    }

    public function additionalProvider()
    {
        $allVersions = Config::get('app', 'integration_versions');
        return [
            ['all', $allVersions],
            ['2010:2012', ['2010', '2011', '2012']],
            ['3000:3002', ['3000', '3001', '3002']],
            ['2200', ['2200']],
        ];
    }
}
<?php
use PHPUnit\Framework\TestCase;
use App\System\RuleHandler\InstallXML;

class InstallXMLTest extends TestCase
{
    /**
     * @dataProvider additionalProvider
     */
    public function testGetKeyRulesByVersion($version, $expected)
    {
        $this->assertSame($expected, InstallXML::getInstallXMLDistributor($version));
    }

    public function additionalProvider()
    {
        return [
            ['2010', '2010'],
            ['2020', '2010'],
            ['3020', '2010'],
        ];
    }
}
<?php
namespace Phoenix\Test\Asset;

use Phoenix\Asset\Asset;

class AssetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testGetFile()
    {
        $asset = new Asset('myfile.js');
        $this->assertEquals('myfile.js', $asset->getFile());

        $asset = new Asset(0);
        $this->assertEquals('0', $asset->getFile());

        $asset = new Asset('');
        $this->assertEquals('', $asset->getFile());

        $asset = new Asset();
    }

    public function testSetIspackage()
    {
        $asset = new Asset('myfile.js');

        $this->assertFalse($asset->isPackage());

        $asset->setIsPackage(true);
        $this->assertTrue($asset->isPackage());

        $asset->setIsPackage(false);
        $this->assertFalse($asset->isPackage());

        $asset->setIsPackage(0);
        $this->assertFalse($asset->isPackage());

        $asset->setIsPackage(1);
        $this->assertTrue($asset->isPackage());
    }
}

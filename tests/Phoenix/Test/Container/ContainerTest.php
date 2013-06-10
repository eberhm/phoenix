<?php
namespace Phoenix\Test\Container;

use Phoenix\Container\Container,
    Mockery as m;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $container = new Container();
        $container->add($this->mockAsset('asset1.js'));
        $container->add($this->mockAsset('asset2.js'));
        $container->add($this->mockAsset('asset1.js'));
        $container->add($this->mockAsset('asset3.js'));
        $container->add($this->mockAsset('asset3.js'));
        $container->add($this->mockAsset('asset2.js'));

        $this->assertCount(3, $container->getAssets());
    }

    /**
     * @param $file
     * @return \Mockery\Mock
     */
    private function mockAsset($file)
    {
        $asset = m::mock('\Phoenix\Asset\Asset');
        $asset->shouldReceive('getFile')->andReturn($file);
        return $asset;
    }
}

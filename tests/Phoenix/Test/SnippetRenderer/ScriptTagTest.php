<?php
namespace Phoenix\Test\SnippetRenderer;

use Phoenix\SnippetRenderer\ScriptTag,
    Mockery as m;

class ScriptTagTest extends \PHPUnit_Framework_TestCase
{
    public $expectedResultNoDecorator = array(
        '<script type="text/javascript" src="myFile1.js"></script>',
        '<script type="text/javascript" src="myFile2.js"></script>');

    public $expectedResultDecorator = array(
        '<script type="text/javascript" src="---"></script>',
        '<script type="text/javascript" src="---"></script>');

    public function testTagWithNoDecorator()
    {
        $renderer = new ScriptTag();
        $this->assertEquals(
            implode(PHP_EOL, $this->expectedResultNoDecorator).PHP_EOL,
            $renderer->render($this->mockContainer())
        );
    }

    public function testTagWithDecorator()
    {
        $renderer = new ScriptTag();
        $renderer->setUrlDecorator($this->mockDecorator());
        $this->assertEquals(
            implode(PHP_EOL, $this->expectedResultDecorator).PHP_EOL,
            $renderer->render($this->mockContainer())
        );
    }

    private function mockContainer()
    {
        $container = m::mock('\Phoenix\Container\Container');
        $container->shouldReceive('getAssets')->andReturn(
            array($this->mockAsset('myFile1.js'), $this->mockAsset('myFile2.js'))
        );

        return $container;
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

    private function mockDecorator()
    {
        $decorator = m::mock('\Phoenix\Asset\UrlDecorator\Base');
        $decorator->shouldReceive('decorate')->andReturn('---');

        return $decorator;
    }
}

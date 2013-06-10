<?php
namespace Phoenix\Test\SnippetRenderer;

use Phoenix\SnippetRenderer\RequireSnippet,
    Mockery as m;

class RequireSnippetTest extends \PHPUnit_Framework_TestCase
{
    public $expectedResultNoDecorator = array(
        'require([',
        '"myFile1.js",',
        '"myFile2.js"',
        '], function() {
            require(["main"]);
        });');

    public $expectedResultDecorator = array(
        'require([',
        '"---",',
        '"---"',
        '], function() {
            require(["main"]);
        });');

    public function testTagWithNoDecorator()
    {
        $renderer = new RequireSnippet();
        $this->assertEquals(
            implode(PHP_EOL, $this->expectedResultNoDecorator),
            $renderer->render($this->mockContainer())
        );
    }

    public function testTagWithDecorator()
    {
        $renderer = new RequireSnippet();
        $renderer->setUrlDecorator($this->mockDecorator());
        $this->assertEquals(
            implode(PHP_EOL, $this->expectedResultDecorator),
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

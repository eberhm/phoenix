<?php
namespace Phoenix\Test\Asset\Decorator;

use Phoenix\Asset\UrlDecorator\Base;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    public function testDecorate()
    {
        $decorator = new Base();

        $this->assertEquals('base.js', $decorator->decorate('base.js'));
    }
}

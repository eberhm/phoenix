<?php
namespace Phoenix\Test\Asset\Decorator;

use Phoenix\Asset\UrlDecorator\Cdn;

class CdnTest extends \PHPUnit_Framework_TestCase
{
    public function testDecorate()
    {
        $decorator = new Cdn();
        $decorator->setBaseUrl('www.baseUrl.com/');

        $this->assertEquals('www.baseUrl.com/base.js', $decorator->decorate('base.js'));
    }
}

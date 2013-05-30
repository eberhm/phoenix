<?php
namespace Phoenix\Asset\UrlDecorator;

class Cdn extends AbstractDecorator
{
    public function decorate($url)
    {
        return 'http://cdn.mycdn.com'.parent::decorate($url);
    }
}

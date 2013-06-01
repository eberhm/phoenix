<?php
namespace Phoenix\Asset\UrlDecorator;

class Cdn extends AbstractDecorator
{
    protected $baseUrl = 'http://cdn.mycdn.com';

    public function decorate($url)
    {
        return $this->baseUrl.parent::decorate($url);
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }
}

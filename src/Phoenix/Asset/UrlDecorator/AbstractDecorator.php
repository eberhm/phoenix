<?php
namespace Phoenix\Asset\UrlDecorator;

class AbstractDecorator implements UrlDecoratorInterface
{

    /** @var UrlDecoratorInterface  */
    protected $decorator;

    public function __construct(UrlDecoratorInterface $decorator = null)
    {
        $this->decorator = $decorator;
    }

    public function decorate($url)
    {
        return $this->decorator ? $this->decorator->decorate($url) : $url;
    }

    /**
     * @param UrlDecoratorInterface $decorator
     */
    public function setDecorator(UrlDecoratorInterface $decorator)
    {
        $this->decorator = $decorator;
    }
}

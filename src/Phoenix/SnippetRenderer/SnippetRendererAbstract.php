<?php

namespace Phoenix\SnippetRenderer;
use Phoenix\Asset\AssetInterface;
use Phoenix\Asset\UrlDecorator\UrlDecoratorInterface;

abstract class SnippetRendererAbstract implements SnippetRendererInterface
{
    /** @var  UrlDecoratorInterface */
    protected $urlDecorator;

    protected function toUrl(AssetInterface $asset)
    {
        $url = $asset->getFile();

        return $this->urlDecorator ? $this->urlDecorator->decorate($url) : $url;
    }

    /**
     * @param UrlDecoratorInterface $urlDecorator
     */
    public function setUrlDecorator(UrlDecoratorInterface $urlDecorator)
    {
        $this->urlDecorator = $urlDecorator;
    }
}

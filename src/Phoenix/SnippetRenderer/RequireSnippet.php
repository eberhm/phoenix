<?php

namespace Phoenix\SnippetRenderer;
use Phoenix\Asset\AssetInterface;
use Phoenix\Container\ContainerInterface;

class RequireSnippet extends SnippetRendererAbstract
{
    public function render(ContainerInterface $container)
    {
        $result = 'require([';
        $assets = $container->getAssets();
        $urls = array();
        foreach ($assets as $asset) {
            /** @var $asset \Phoenix\Asset\AssetInterface $url */
            $urls[] = '"'.$this->toUrl($asset).'"';
        }

        $result .= implode(',', $urls);
        $result .= '], function() {
            require 'main';
        });';

        return $result;
    }
}

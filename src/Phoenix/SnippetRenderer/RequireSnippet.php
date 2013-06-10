<?php

namespace Phoenix\SnippetRenderer;
use Phoenix\Asset\AssetInterface;
use Phoenix\Container\ContainerInterface;

class RequireSnippet extends SnippetRendererAbstract
{
    public function render(ContainerInterface $container)
    {
        $result = 'require(['.PHP_EOL;
        $assets = $container->getAssets();
        $urls = array();
        foreach ($assets as $asset) {
            /** @var $asset \Phoenix\Asset\AssetInterface $url */
            $urls[] = '"'.$this->toUrl($asset).'"';
        }

        $result .= implode(','.PHP_EOL, $urls);
        $result .= PHP_EOL.'], function() {
            require(["main"]);
        });';

        return $result;
    }
}

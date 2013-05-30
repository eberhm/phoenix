<?php

namespace Phoenix\SnippetRenderer;
use Phoenix\Asset\AssetInterface;
use Phoenix\Container\ContainerInterface;

class ScriptTag extends SnippetRendererAbstract
{
    public function render(ContainerInterface $container)
    {
        $result = '';
        $assets = $container->getAssets();
        foreach ($assets as $asset) {
            /** @var $asset \Phoenix\Asset\AssetInterface $url */
            $result .= $this->getTagScript($asset);
        }

        return $result;
    }

    private function getTagScript(AssetInterface $asset)
    {
        return '<script type="text/javascript" src="' .
            $this->toUrl($asset).'"></script>'.PHP_EOL;
    }
}

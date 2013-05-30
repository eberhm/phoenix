<?php

namespace Phoenix\Container;

use Phoenix\Asset\AssetInterface;

class Container implements ContainerInterface
{
    private $assets = array();

    private $files = array();

    public function add(AssetInterface $asset)
    {
        if (!in_array($asset->getFile(), $this->files)) {
            array_push($this->assets, $asset);
            $this->files[] = $asset->getFile();
        }
    }

    /**
     * @return [Asset]
     */
    public function getAssets()
    {
        return $this->assets;
    }
}

<?php
namespace Phoenix\Container;

use Phoenix\Asset\AssetInterface;

interface ContainerInterface
{
    public function add(AssetInterface $asset);

    /**
     *@return \Phoenix\Asset\AssetInterface[]
     */
    public function getAssets();
}

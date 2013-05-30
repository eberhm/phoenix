<?php

namespace Phoenix\Asset;

interface AssetInterface
{
    public function getFile();

    /**
     * @param boolean $isPackage
     */
    public function setIsPackage($isPackage);

    /**
     * @return boolean
     */
    public function isPackage();
}

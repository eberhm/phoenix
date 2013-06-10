<?php

namespace Phoenix\Asset;

class Asset implements AssetInterface
{
    /** @var bool */
    protected $isPackage = false;

    /** @var  string */
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @param boolean $isPackage
     */
    public function setIsPackage($isPackage)
    {
        $this->isPackage = $isPackage;
    }

    /**
     * @return boolean
     */
    public function isPackage()
    {
        return (bool)$this->isPackage;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return (string)$this->file;
    }
}
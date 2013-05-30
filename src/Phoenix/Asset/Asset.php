<?php

namespace Phoenix\Asset;

class Asset extends AssetAbstract
{
    /** @var  string */
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @return array
     */
    public function getFile()
    {
        return $this->file;
    }
}

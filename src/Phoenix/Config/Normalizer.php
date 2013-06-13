<?php

namespace Phoenix\Config;

class Normalizer
{
    private $defaults = array(
        'debug'             => false,
        'batchController'   => '',
        'jsRootFolder'      => '',
        'publicRootFolder'  => '',
        'packages'          => array(),
        'batchSize' => 0
    );
    public function normalize($config)
    {
        return array_merge($this->defaults, $config);
    }
}
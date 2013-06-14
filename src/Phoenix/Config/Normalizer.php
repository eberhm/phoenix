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
        $config = array_merge($this->defaults, $config);

        $config['jsRootFolder'] = $this->normalizePath($config['jsRootFolder']);
        $config['publicRootFolder'] = $this->normalizePath($config['publicRootFolder']);
        $config['batchController'] = $this->normalizePath($config['batchController']);

        return $config;
    }

    private function normalizePath($path)
    {
        return substr($path, -1) === '/' ? $path : $path.'/';
    }
}
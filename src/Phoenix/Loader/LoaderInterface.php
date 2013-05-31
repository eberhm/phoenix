<?php
namespace Phoenix\Loader;

interface LoaderInterface
{
    public function setConfig($config);

    /**
     * @param $file
     */
    public function load($file);

    /**
     * @return \Phoenix\Container\ContainerInterface
     */
    public function buildContainer();
}

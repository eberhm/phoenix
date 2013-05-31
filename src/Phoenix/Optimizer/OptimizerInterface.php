<?php

namespace Phoenix\Optimizer;


interface OptimizerInterface
{
    public function setConfig($config);

    public function optimizeFiles($files);

    public function optimizePackages();
}

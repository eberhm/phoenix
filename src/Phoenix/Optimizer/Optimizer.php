<?php

namespace Phoenix\Optimizer;

use Assetic\Factory\AssetFactory;
use Assetic\FilterManager;
use Assetic\AssetManager;
use Assetic\Filter\Yui\JsCompressorFilter;

class Optimizer implements OptimizerInterface
{
    /**
     * @var array
     */
    protected $config = array();

    public function __construct($config)
    {
        $this->setConfig($config);
    }

    public function setConfig($config)
    {
        $normalizer = new \Phoenix\Config\Normalizer();
        $this->config = $normalizer->normalize($config);
    }

    public function optimizeFiles($files)
    {
        return $this->optimize(
            $files,
            $this->getAssetFactory(
                $this->getFullRoot(),
                $this->config['debug']
            )
        );
    }

    public function optimizePackages()
    {
        $fullRoot = $this->getFullRoot();

        $assetFactory = $this->getAssetFactory($fullRoot, $this->config['debug']);

        foreach ($this->config['packages'] as $packageName => $files) {
            file_put_contents(
                $fullRoot .'/packages/'.$packageName.'.js',
                $this->optimize(
                    $files,
                    $assetFactory
                ).PHP_EOL
            );
        }

    }

    private function optimize($files, AssetFactory $assetFactory)
    {
        return $assetFactory->createAsset($files, '?yui_js')->dump();
    }

    /**
     * @param $rootPath
     * @param $debug
     * @return AssetFactory
     */
    private function getAssetFactory($rootPath, $debug)
    {
        $filterManager = new FilterManager();
        $filterManager->set('yui_js', new JsCompressorFilter(dirname(__DIR__) . '/../optimizers/yuicompressor/yuicompressor-2.4.7.jar'));

        $assetFactory = new AssetFactory($rootPath, $debug);
        $assetFactory->setFilterManager($filterManager);
        $assetFactory->setAssetManager(new AssetManager());

        return $assetFactory;
    }

    /**
     * @return string
     */
    private function getFullRoot()
    {
        return $this->config['publicRootFolder'] . $this->config['jsRootFolder'];
    }
}

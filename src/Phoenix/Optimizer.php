<?php

namespace Phoenix;

use Assetic\Factory\AssetFactory;
use Assetic\FilterManager;
use Assetic\AssetManager;
use Assetic\Filter\Yui\JsCompressorFilter;

class Optimizer
{
    /**
     * @var array
     */
    protected $config = array();

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function optimize($rootPath, $debug = false)
    {
        $assetFactory = $this->getAssetFactory($rootPath, $debug);

        foreach ($this->config['packages'] as $packageName => $files) {
            $content = '';
            foreach ($files as $file) {
                $content .= PHP_EOL.$this->optimizeFile(
                    $rootPath.$this->config['jsRootFolder'].$file,
                    $assetFactory
                );
            }
            file_put_contents(
                $rootPath.$this->config['jsRootFolder'].'/packages/'.$packageName.'.js',
                $content
            );
        }

    }

    private function optimizeFile($file, AssetFactory $assetFactory)
    {
        if (!file_exists($file)) {
            throw new \Exception(sprintf('File "%s" does not exist!', $file));
        }

        return $assetFactory->createAsset(array($file), '?yui_js')->dump();
    }

    /**
     * @param $rootPath
     * @param $debug
     * @return AssetFactory
     */
    private function getAssetFactory($rootPath, $debug)
    {
        $filterManager = new FilterManager();
        $filterManager->set('yui_js', new JsCompressorFilter(dirname(__DIR__) . '/optimizers/yuicompressor/yuicompressor-2.4.7.jar'));

        $assetFactory = new AssetFactory($rootPath, $debug);
        $assetFactory->setFilterManager($filterManager);
        $assetFactory->setAssetManager(new AssetManager());

        return $assetFactory;
    }
}

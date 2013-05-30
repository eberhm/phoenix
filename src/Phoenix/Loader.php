<?php
namespace Phoenix;

use Phoenix\Container\Container,
    Phoenix\Asset\Asset;

class Loader
{
    /**
     * @var array
     */
    protected $files = array();

    /**
     * @var \Phoenix\Container\ContainerInterface
     */
    private $container;

    /**
     * @var array
     */
    private $config;

    public function __construct(array $config = array())
    {
        $this->config = $config;
    }

    /**
     * @param $file
     */
    public function load($file)
    {
        $this->addFile($file);

        /*

        */

        return $this;
    }

    private function getJsPackageName($file)
    {
        $packages = @$this->config['packages'] ?: array();
        foreach ($packages as $name => $files) {
            if (in_array($file, $files)) {
                return $name;
            }
        }

        return null;
    }

    private function useBatches()
    {
        return (bool) $this->getBatchSize();
    }

    private function getBatchSize()
    {
        return @$this->config['batchSize'] ?: 0;
    }

    /**
     * @return \Phoenix\Container\ContainerInterface
     */
    public function buildContainer()
    {
        $container = new Container();
        $i = 0;
        $sections = array();

        foreach ($this->files as $file) {
            $jsPackageName = $this->getJsPackageName($file);
            if ($jsPackageName) {
                $file = '/packages/' . $jsPackageName . '.js';

                $asset = new Asset($this->getFinalPath($file));
                $asset->setIsPackage(true);
                $container->add($asset);
                continue;
            }

            if (!$this->useBatches()) {
                $container->add(new Asset($this->getFinalPath($file)));
            } else {
                $sections[intval($i++/$this->getBatchSize())][] = $file;
            }
        }

        if (count($sections)) {
            foreach ($sections as $aSection) {
                $container->add(
                    new Asset(
                        $this->getFinalPath(
                            $this->config['batchController'].base64_encode(implode(',', $aSection)).'.js'
                        )
                    )
                );
            }
        }

        return $container;
    }

    private function addFile($file)
    {
        if (!in_array($file, $this->files)) {
            array_push($this->files, $file);
        }
    }

    private function getFinalPath($file)
    {
        return $this->config['jsRootFolder'].$file;
    }
}

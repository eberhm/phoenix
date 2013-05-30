<?php

namespace Phoenix\SnippetRenderer;
use Phoenix\Container\ContainerInterface;

interface SnippetRendererInterface
{
    public function render(ContainerInterface $container);
}

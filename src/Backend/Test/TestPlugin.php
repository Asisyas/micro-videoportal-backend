<?php

namespace App\Backend\Test;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class TestPlugin extends AbstractPlugin
{
    public function provideDependencies(Container $container): void
    {
        parent::provideDependencies($container);
    }
}
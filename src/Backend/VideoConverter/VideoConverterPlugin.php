<?php

namespace App\Backend\VideoConverter;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class VideoConverterPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {

    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoConverterPluginBackend';
    }
}
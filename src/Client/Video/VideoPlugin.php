<?php

namespace App\Client\Video;

use App\Client\Video\Client\VideoClientInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class VideoPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoClientInterface::class, function () {
            return $this->createClient();
        });
    }

    /**
     * @return VideoClientInterface
     */
    protected function createClient(): VideoClientInterface
    {

    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoPluginClient';
    }
}
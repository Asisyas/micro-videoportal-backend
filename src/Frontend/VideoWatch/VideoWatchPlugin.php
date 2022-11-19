<?php

namespace App\Frontend\VideoWatch;

use App\Client\Video\Client\VideoClientInterface;
use App\Frontend\VideoWatch\Facade\VideoWatchFacade;
use App\Frontend\VideoWatch\Facade\VideoWatchFacadeInterface;
use App\Frontend\VideoWatch\Factory\VideoGetTransferFactory;
use App\Frontend\VideoWatch\Factory\VideoGetTransferFactoryInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class VideoWatchPlugin extends AbstractPlugin
{

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoWatchFacadeInterface::class, function () {

            return $this->createFacade();
        });
    }

    /**
     * @return VideoWatchFacadeInterface
     */
    protected function createFacade(): VideoWatchFacadeInterface
    {
        return new VideoWatchFacade(
        );
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoWatchPluginFrontend';
    }
}
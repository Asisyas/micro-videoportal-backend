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
     * @var VideoClientInterface
     */
    private readonly VideoClientInterface $videoClient;

    /**
     * @var FilesystemFacadeInterface
     */
    private readonly FilesystemFacadeInterface $filesystemFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoWatchFacadeInterface::class, function (
            VideoClientInterface $videoClient,
            FilesystemFacadeInterface $filesystemFacade
        ) {
            $this->videoClient = $videoClient;
            $this->filesystemFacade = $filesystemFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoWatchFacadeInterface
     */
    protected function createFacade(): VideoWatchFacadeInterface
    {
        return new VideoWatchFacade(
            $this->videoClient,
            $this->createVideoGetTransferFactory(),
            $this->filesystemFacade
        );
    }

    /**
     * @return VideoGetTransferFactoryInterface
     */
    protected function createVideoGetTransferFactory(): VideoGetTransferFactoryInterface
    {
        return new VideoGetTransferFactory();
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoWatchPluginFrontend';
    }
}
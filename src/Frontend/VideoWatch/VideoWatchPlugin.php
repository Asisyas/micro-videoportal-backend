<?php

namespace App\Frontend\VideoWatch;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Frontend\VideoWatch\Facade\VideoWatchFacade;
use App\Frontend\VideoWatch\Facade\VideoWatchFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class VideoWatchPlugin extends AbstractPlugin
{
    /**
     * @var ClientReaderFacadeInterface
     */
    private readonly ClientReaderFacadeInterface $clientReaderFacade;

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
            ClientReaderFacadeInterface $clientReaderFacade,
            FilesystemFacadeInterface $filesystemFacade
        ) {
            $this->clientReaderFacade = $clientReaderFacade;
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
            $this->clientReaderFacade,
            $this->filesystemFacade
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
<?php

namespace App\Frontend\VideoWatch;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\VideoChannel\Client\VideoChannelClientInterface;
use App\Frontend\VideoWatch\Exapnder\Impl\ChannelExpander;
use App\Frontend\VideoWatch\Exapnder\Impl\SrcExpander;
use App\Frontend\VideoWatch\Exapnder\VideoWatchExpanderFactory;
use App\Frontend\VideoWatch\Exapnder\VideoWatchExpanderFactoryInterface;
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
     * @var VideoChannelClientInterface
     */
    private readonly VideoChannelClientInterface $videoChannelClient;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoWatchFacadeInterface::class, function (
            ClientReaderFacadeInterface     $clientReaderFacade,
            FilesystemFacadeInterface       $filesystemFacade,
            VideoChannelClientInterface     $videoChannelClient
        ) {
            $this->clientReaderFacade =     $clientReaderFacade;
            $this->filesystemFacade =       $filesystemFacade;
            $this->videoChannelClient =     $videoChannelClient;

            return $this->createFacade();
        });
    }

    protected function createFacade(): VideoWatchFacade
    {
        return new VideoWatchFacade(
            $this->clientReaderFacade,
            $this->createVideoWatchExpanderFactory()
        );
    }

    protected function createVideoWatchExpanderFactory(): VideoWatchExpanderFactory
    {
        return new VideoWatchExpanderFactory(
            new ChannelExpander($this->videoChannelClient),
            new SrcExpander($this->filesystemFacade)
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

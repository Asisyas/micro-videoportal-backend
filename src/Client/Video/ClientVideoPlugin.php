<?php

namespace App\Client\Video;

use App\Client\ClientReader\ClientReaderPlugin;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\Video\Client\ClientVideo;
use App\Client\Video\Client\ClientVideoInterface;
use App\Client\Video\Publisher\VideoPublisherFactory;
use App\Client\Video\Publisher\VideoPublisherFactoryInterface;
use App\Client\Video\Reader\VideoReaderFactory;
use App\Client\Video\Reader\VideoReaderFactoryInterface;
use App\Client\Video\Storage\VideoStorageFactory;
use App\Client\Video\Storage\VideoStorageFactoryInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Facade\VideoTransferExpanderFacadeInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\VideoTransferExpanderPlugin;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;
use Micro\Plugin\Temporal\TemporalPlugin;

class ClientVideoPlugin implements DependencyProviderInterface, PluginDependedInterface
{
    /**
     * @var ClientReaderFacadeInterface
     */
    private readonly ClientReaderFacadeInterface $clientReaderFacade;

    /**
     * @var TemporalFacadeInterface
     */
    private readonly TemporalFacadeInterface $temporalFacade;

    /**
     * @var VideoTransferExpanderFacadeInterface
     */
    private readonly VideoTransferExpanderFacadeInterface $videoTransferExpanderFacade;


    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(ClientVideoInterface::class, function (
            ClientReaderFacadeInterface $clientReaderFacade,
            VideoTransferExpanderFacadeInterface $videoTransferExpanderFacade,
            TemporalFacadeInterface $temporalFacade
        ) {
            $this->temporalFacade = $temporalFacade;
            $this->clientReaderFacade = $clientReaderFacade;
            $this->videoTransferExpanderFacade = $videoTransferExpanderFacade;

            return $this->createClient();
        });
    }

    /**
     * @return ClientVideoInterface
     */
    protected function createClient(): ClientVideoInterface
    {
        return new ClientVideo(
            $this->createVideoReaderFactory(),
            $this->createVideoStorageFactory(),
            $this->createVideoPublisherFactory()
        );
    }

    /**
     * @return VideoPublisherFactoryInterface
     */
    protected function createVideoPublisherFactory(): VideoPublisherFactoryInterface
    {
        return new VideoPublisherFactory($this->temporalFacade);
    }

    /**
     * @return VideoStorageFactoryInterface
     */
    protected function createVideoStorageFactory(): VideoStorageFactoryInterface
    {
        return new VideoStorageFactory($this->temporalFacade);
    }

    /**
     * @return VideoReaderFactoryInterface
     */
    protected function createVideoReaderFactory(): VideoReaderFactoryInterface
    {
        return new VideoReaderFactory(
            $this->clientReaderFacade,
            $this->videoTransferExpanderFacade
        );
    }

    public function getDependedPlugins(): iterable
    {
        return [
            VideoTransferExpanderPlugin::class,
            ClientReaderPlugin::class,
            TemporalPlugin::class,
        ];
    }
}

<?php

namespace App\Client\Video;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\Video\Client\VideoClient;
use App\Client\Video\Client\VideoClientInterface;
use App\Client\Video\Publisher\VideoPublisherFactory;
use App\Client\Video\Publisher\VideoPublisherFactoryInterface;
use App\Client\Video\Reader\VideoReaderFactory;
use App\Client\Video\Reader\VideoReaderFactoryInterface;
use App\Client\Video\Storage\VideoStorageFactory;
use App\Client\Video\Storage\VideoStorageFactoryInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;

class VideoClientPlugin extends AbstractPlugin
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
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoClientInterface::class, function(
            ClientReaderFacadeInterface $clientReaderFacade,
            TemporalFacadeInterface $temporalFacade
        ) {
            $this->temporalFacade = $temporalFacade;
            $this->clientReaderFacade = $clientReaderFacade;

            return $this->createClient();
        });
    }

    /**
     * @return VideoClientInterface
     */
    protected function createClient(): VideoClientInterface
    {
        return new VideoClient(
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
            $this->clientReaderFacade
        );
    }
}
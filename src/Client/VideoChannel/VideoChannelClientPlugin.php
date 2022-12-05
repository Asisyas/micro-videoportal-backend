<?php

namespace App\Client\VideoChannel;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\Search\Client\SearchClientInterface;
use App\Client\VideoChannel\Client\VideoChannelClient;
use App\Client\VideoChannel\Client\VideoChannelClientInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;

class VideoChannelClientPlugin extends AbstractPlugin
{
    /**
     * @var TemporalFacadeInterface
     */
    private readonly TemporalFacadeInterface $temporalFacade;
    /**
     * @var ClientReaderFacadeInterface
     */
    private readonly ClientReaderFacadeInterface $clientReaderFacade;

    /**
     * @var SearchClientInterface
     */
    private readonly SearchClientInterface $searchClient;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoChannelClientInterface::class, function (
            TemporalFacadeInterface $temporalFacade,
            ClientReaderFacadeInterface $clientReaderFacade,
            SearchClientInterface $searchClient
        ): VideoChannelClientInterface {
            $this->temporalFacade = $temporalFacade;
            $this->clientReaderFacade = $clientReaderFacade;
            $this->searchClient = $searchClient;

            return $this->createClient();
        });
    }

    /**
     * @return VideoChannelClientInterface
     */
    protected function createClient(): VideoChannelClientInterface
    {
        return new VideoChannelClient(
            $this->temporalFacade,
            $this->clientReaderFacade,
            $this->searchClient
        );
    }
}
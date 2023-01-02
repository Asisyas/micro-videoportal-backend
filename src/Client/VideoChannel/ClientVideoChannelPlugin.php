<?php

namespace App\Client\VideoChannel;

use App\Client\ClientReader\ClientReaderPlugin;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\Search\Client\ClientSearchInterface;
use App\Client\Search\ClientSearchPlugin;
use App\Client\VideoChannel\Client\Client;
use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;
use Micro\Plugin\Temporal\TemporalPlugin;

class ClientVideoChannelPlugin implements DependencyProviderInterface, PluginDependedInterface
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
     * @var ClientSearchInterface
     */
    private readonly ClientSearchInterface $searchClient;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(ClientVideoChannelInterface::class, function (
            TemporalFacadeInterface $temporalFacade,
            ClientReaderFacadeInterface $clientReaderFacade,
            ClientSearchInterface $searchClient
        ): ClientVideoChannelInterface {
            $this->temporalFacade = $temporalFacade;
            $this->clientReaderFacade = $clientReaderFacade;
            $this->searchClient = $searchClient;

            return $this->createClient();
        });
    }

    /**
     * @return ClientVideoChannelInterface
     */
    protected function createClient(): ClientVideoChannelInterface
    {
        return new Client(
            $this->temporalFacade,
            $this->clientReaderFacade,
            $this->searchClient
        );
    }

    public function getDependedPlugins(): iterable
    {
        return [
            TemporalPlugin::class,
            ClientReaderPlugin::class,
            ClientSearchPlugin::class,
        ];
    }
}

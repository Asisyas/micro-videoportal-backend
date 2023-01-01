<?php

namespace App\Client\Search;

use App\Client\ClientReader\ClientReaderPlugin;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\Search\Client\ClientSearch;
use App\Client\Search\Client\ClientSearchInterface;
use App\Client\Search\Engine\ElasticEngineFactory;
use App\Client\Search\Engine\SearchEngineFactoryInterface;
use App\Client\Search\Expander\SearchResults\SearchResultsExpanderFactory;
use App\Client\Search\Expander\SearchResults\SearchResultsExpanderFactoryInterface;
use App\Client\Search\Expander\SearchResults\Video\TemporaryExpander;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Elastic\ElasticPlugin;
use Micro\Plugin\Elastic\Facade\ElasticFacadeInterface;

class ClientSearchPlugin implements DependencyProviderInterface, PluginDependedInterface
{
    /**
     * @var ElasticFacadeInterface
     */
    private readonly ElasticFacadeInterface $elasticFacade;

    /**
     * @var ClientReaderFacadeInterface
     */
    private readonly ClientReaderFacadeInterface $clientReaderFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(ClientSearchInterface::class, function (
            ElasticFacadeInterface $elasticFacade,
            ClientReaderFacadeInterface $clientReaderFacade
        ) {
            $this->elasticFacade = $elasticFacade;
            $this->clientReaderFacade = $clientReaderFacade;

            return $this->createClient();
        });
    }

    /**
     * @return ClientSearchInterface
     */
    public function createClient(): ClientSearchInterface
    {
        return new ClientSearch(
            $this->createSearchEngineFactory()
        );
    }

    /**
     * @return SearchEngineFactoryInterface
     */
    public function createSearchEngineFactory(): SearchEngineFactoryInterface
    {
        return new ElasticEngineFactory(
            $this->elasticFacade,
            $this->createSearchResultsExpanderFactory()
        );
    }

    /**
     * @return SearchResultsExpanderFactoryInterface
     */
    public function createSearchResultsExpanderFactory(): SearchResultsExpanderFactoryInterface
    {
        return new SearchResultsExpanderFactory(
            new TemporaryExpander($this->clientReaderFacade)
        );
    }

    public function getDependedPlugins(): iterable
    {
        return [
            ElasticPlugin::class,
            ClientReaderPlugin::class,
        ];
    }
}

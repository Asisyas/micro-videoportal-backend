<?php

namespace App\Client\Search;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\Search\Client\SearchClient;
use App\Client\Search\Client\SearchClientInterface;
use App\Client\Search\Engine\ElasticEngineFactory;
use App\Client\Search\Engine\SearchEngineFactoryInterface;
use App\Client\Search\Expander\SearchResults\SearchResultsExpanderFactory;
use App\Client\Search\Expander\SearchResults\SearchResultsExpanderFactoryInterface;
use App\Client\Search\Expander\SearchResults\Video\TemporaryExpander;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Elastic\Facade\ElasticFacadeInterface;

class SearchClientPlugin extends AbstractPlugin
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
        $container->register(SearchClientInterface::class, function (
            ElasticFacadeInterface $elasticFacade,
            ClientReaderFacadeInterface $clientReaderFacade
        ) {
            $this->elasticFacade = $elasticFacade;
            $this->clientReaderFacade = $clientReaderFacade;

            return $this->createClient();
        });
    }

    public function createClient(): SearchClient
    {
        return new SearchClient(
            $this->createSearchEngineFactory()
        );
    }

    public function createSearchEngineFactory(): ElasticEngineFactory
    {
        return new ElasticEngineFactory(
            $this->elasticFacade,
            $this->createSearchResultsExpanderFactory()
        );
    }

    public function createSearchResultsExpanderFactory(): SearchResultsExpanderFactory
    {
        return new SearchResultsExpanderFactory(
            new TemporaryExpander($this->clientReaderFacade)
        );
    }
}

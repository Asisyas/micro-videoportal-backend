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

    /**
     * @return SearchClientInterface
     */
    public function createClient(): SearchClientInterface
    {
        return new SearchClient(
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
}
<?php

namespace App\Client\Search;

use App\Client\Search\Client\SearchClient;
use App\Client\Search\Client\SearchClientInterface;
use App\Client\Search\Engine\ElasticEngineFactory;
use App\Client\Search\Engine\SearchEngineFactoryInterface;
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
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(SearchClientInterface::class, function (
            ElasticFacadeInterface $elasticFacade
        ) {
            $this->elasticFacade = $elasticFacade;

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
        return new ElasticEngineFactory($this->elasticFacade);
    }
}
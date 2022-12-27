<?php

namespace App\Client\Search\Engine;

use App\Client\Search\Expander\SearchResults\SearchResultsExpanderFactoryInterface;
use Micro\Plugin\Elastic\Facade\ElasticFacadeInterface;

class ElasticEngineFactory implements SearchEngineFactoryInterface
{
    /**
     * @param ElasticFacadeInterface $elasticFacade
     * @param SearchResultsExpanderFactoryInterface $resultsExpanderFactory
     */
    public function __construct(
        private readonly ElasticFacadeInterface $elasticFacade,
        private readonly SearchResultsExpanderFactoryInterface $resultsExpanderFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): SearchEngineInterface
    {
        return new ElasticEngine(
            $this->elasticFacade->createClient(),
            $this->resultsExpanderFactory->create()
        );
    }
}

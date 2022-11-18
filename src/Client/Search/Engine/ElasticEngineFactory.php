<?php

namespace App\Client\Search\Engine;

use Micro\Plugin\Elastic\Facade\ElasticFacadeInterface;

class ElasticEngineFactory implements SearchEngineFactoryInterface
{
    /**
     * @param ElasticFacadeInterface $elasticFacade
     */
    public function __construct(
        private readonly ElasticFacadeInterface $elasticFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): SearchEngineInterface
    {
        return new ElasticEngine($this->elasticFacade->createClient());
    }
}
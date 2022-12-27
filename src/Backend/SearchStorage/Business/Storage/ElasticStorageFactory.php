<?php

namespace App\Backend\SearchStorage\Business\Storage;

use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Elastic\Facade\ElasticFacadeInterface;

class ElasticStorageFactory implements StorageFactoryInterface
{
    /**
     * @param ElasticFacadeInterface $elasticFacade
     * @param SerializerFacadeInterface $serializerFacade
     */
    public function __construct(
        private readonly ElasticFacadeInterface $elasticFacade,
        private readonly SerializerFacadeInterface $serializerFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): StorageInterface
    {
        return new ElasticStorage(
            $this->elasticFacade->createClient(),
            $this->serializerFacade
        );
    }
}

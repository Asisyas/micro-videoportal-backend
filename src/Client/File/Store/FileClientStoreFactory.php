<?php

namespace App\Client\File\Store;

use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;

class FileClientStoreFactory implements FileClientStoreFactoryInterface
{
    /**
     * @param TemporalFacadeInterface $temporalFacade
     */
    public function __construct(
        private readonly TemporalFacadeInterface $temporalFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): FileClientStoreInterface
    {
        return new FileClientStore($this->temporalFacade->workflowClient());
    }
}
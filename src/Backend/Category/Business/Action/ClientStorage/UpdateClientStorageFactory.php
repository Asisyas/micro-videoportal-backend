<?php

namespace App\Backend\Category\Business\Action;

use App\Backend\Category\Business\Storage\StorageManagerFactoryInterface;

class UpdateClientStorageFactory implements ActionFactoryInterface
{
    /**
     * @param StorageManagerFactoryInterface $storageManagerFactory
     */
    public function __construct(private readonly StorageManagerFactoryInterface $storageManagerFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ActionInterface
    {
        return new UpdateClientStorage($this->storageManagerFactory->create());
    }
}
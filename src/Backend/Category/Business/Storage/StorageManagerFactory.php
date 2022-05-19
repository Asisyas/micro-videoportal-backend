<?php

namespace App\Backend\Category\Business\Storage;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;

class StorageManagerFactory implements StorageManagerFactoryInterface
{
    /**
     * @param ClientStorageFacadeInterface $clientStorageFacade
     */
    public function __construct(private readonly ClientStorageFacadeInterface $clientStorageFacade)
    {
    }

    /**
     * @return StorageManagerInterface
     */
    public function create(): StorageManagerInterface
    {
        return new StorageManager($this->clientStorageFacade);
    }
}
<?php

namespace App\Backend\File\Business\File\Storage;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;

class FileStorageFactory implements FileStorageFactoryInterface
{
    /**
     * @param ClientStorageFacadeInterface $clientStorageFacade
     */
    public function __construct(
        private readonly ClientStorageFacadeInterface $clientStorageFacade
    ) {
    }

    /**
     * @return FileStorage
     */
    public function create(): FileStorageInterface
    {
        return new FileStorage($this->clientStorageFacade);
    }
}

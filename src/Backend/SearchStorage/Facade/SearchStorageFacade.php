<?php

namespace App\Backend\SearchStorage\Facade;

use App\Backend\SearchStorage\Business\Storage\StorageFactoryInterface;
use App\Shared\Generated\DTO\Search\IndexAddTransfer;

class SearchStorageFacade implements SearchStorageFacadeInterface
{
    /**
     * @param StorageFactoryInterface $storageFactory
     */
    public function __construct(
        private readonly StorageFactoryInterface $storageFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function index(IndexAddTransfer $indexAddTransfer): void
    {
        $this->storageFactory
            ->create()
            ->index($indexAddTransfer);
    }
}

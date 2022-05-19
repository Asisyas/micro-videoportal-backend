<?php

namespace App\Backend\Category\Business\Action;

use App\Backend\Category\Business\Storage\StorageManagerInterface;
use App\Shared\Generated\DTO\Category\CategoryTransfer;

class UpdateClientStorage implements ActionInterface
{
    /**
     * @param StorageManagerInterface $storageManager
     */
    public function __construct(private readonly StorageManagerInterface $storageManager)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function process(CategoryTransfer $categoryTransfer): void
    {
        $this->storageManager->put($categoryTransfer);
    }
}
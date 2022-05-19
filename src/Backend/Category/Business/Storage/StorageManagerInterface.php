<?php

namespace App\Backend\Category\Business\Storage;

use App\Shared\Generated\DTO\Category\CategoryTransfer;

interface StorageManagerInterface
{
    /**
     * @param CategoryTransfer $categoryTransfer
     *
     * @return void
     */
    public function put(CategoryTransfer $categoryTransfer): void;
}
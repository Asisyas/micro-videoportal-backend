<?php

namespace App\Backend\Category\Business\Expander\CategoryTransfer;

use App\Shared\Generated\DTO\Category\CategoryTransfer;

interface CategoryTransferExpanderInterface
{
    /**
     * @param CategoryTransfer $categoryTransfer
     *
     * @return void
     */
    public function expand(CategoryTransfer $categoryTransfer): void;
}
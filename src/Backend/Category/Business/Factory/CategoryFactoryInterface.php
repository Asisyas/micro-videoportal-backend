<?php

namespace App\Backend\Category\Business\Factory;

use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;
use App\Shared\Generated\DTO\Category\CategoryTransfer;

interface CategoryFactoryInterface
{
    /**
     * @param CategoryCreateTransfer $createCategoryTransfer
     *
     * @return CategoryTransfer
     */
    public function create(CategoryCreateTransfer $createCategoryTransfer): CategoryTransfer;
}
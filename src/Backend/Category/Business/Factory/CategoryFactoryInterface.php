<?php

namespace App\Backend\Category\Business\Factory;

use App\Shared\Generated\DTO\Category\CategoryTransfer;
use App\Shared\Generated\DTO\Category\CreateCategoryTransfer;

interface CategoryFactoryInterface
{
    /**
     * @param CreateCategoryTransfer $createCategoryTransfer
     *
     * @return CategoryTransfer
     */
    public function create(CreateCategoryTransfer $createCategoryTransfer): CategoryTransfer;
}
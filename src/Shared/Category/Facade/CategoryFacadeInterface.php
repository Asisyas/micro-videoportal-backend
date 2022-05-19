<?php

namespace App\Shared\Category\Facade;

use App\Shared\Generated\DTO\Category\CategoryTransfer;
use App\Shared\Generated\DTO\Category\CreateCategoryTransfer;

interface CategoryFacadeInterface
{
    /**
     * @param CreateCategoryTransfer $createCategoryTransfer
     *
     * @return CategoryTransfer
     */
    public function createCategory(CreateCategoryTransfer $createCategoryTransfer): CategoryTransfer;

    public function deleteCategory();
}
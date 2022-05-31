<?php

namespace App\Shared\Category\Facade;

use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;
use App\Shared\Generated\DTO\Category\CategoryTransfer;

interface CategoryFacadeInterface
{
    /**
     * @param CategoryCreateTransfer $categoryCreateTransfer
     *
     * @return CategoryTransfer
     */
    public function createCategory(CategoryCreateTransfer $categoryCreateTransfer): CategoryTransfer;

//    public function deleteCategory();
}
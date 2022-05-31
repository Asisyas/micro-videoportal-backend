<?php

namespace App\Frontend\Category\Facade;

use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;
use App\Shared\Generated\DTO\Category\CategoryTransfer;

class CategoryFacade implements CategoryFacadeInterface
{
    public function createCategory(CategoryCreateTransfer $categoryCreateTransfer): CategoryTransfer
    {
        return new CategoryTransfer();
    }

    public function deleteCategory()
    {
    }
}
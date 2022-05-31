<?php

namespace App\Backend\Category\Business\Expander\CategoryTransfer;

use App\Backend\Category\Entity\Category;
use App\Shared\Generated\DTO\Category\CategoryTransfer;

interface ExpanderInterface
{
    /**
     * @param CategoryTransfer $categoryTransfer
     * @param Category|null $category
     *
     * @return void
     */
    public function expand(CategoryTransfer $categoryTransfer, ?Category $category): void;
}
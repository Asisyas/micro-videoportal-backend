<?php

namespace App\Backend\Category\Business\Expander\CategoryTransfer\Expander;

use App\Backend\Category\Business\Expander\CategoryTransfer\ExpanderInterface;
use App\Backend\Category\Entity\Category;
use App\Shared\Generated\DTO\Category\CategoryTransfer;

class ParentCategoryExpander implements ExpanderInterface
{
    /**
     * @param CategoryTransfer $categoryTransfer
     * @param Category|null $category\
     *
     * @return void
     */
    public function expand(CategoryTransfer $categoryTransfer, ?Category $category): void
    {
        if(!$category) {
            return;
        }

 //       $parentCategoryUuid = $category->getParentCategoryUuid();
 //       if(!$parentCategoryUuid) {
 //           return;
  //      }
    }
}
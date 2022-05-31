<?php

namespace App\Backend\Category\Business\Expander\CategoryTransfer\Expander;

use App\Backend\Category\Business\Expander\CategoryTransfer\ExpanderInterface;
use App\Backend\Category\Entity\Category;
use App\Shared\Generated\DTO\Category\CategoryTransfer;

class BaseFieldExpander implements ExpanderInterface
{
    /**
     * {@inheritDoc}
     */
    public function expand(CategoryTransfer $categoryTransfer, ?Category $category): void
    {
        if(!$category) {
            return;
        }

        $categoryTransfer->setUuid($category->getUuid());
        $categoryTransfer->setName($category->getName());
    }
}
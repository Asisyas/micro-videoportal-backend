<?php

namespace App\Backend\Category\Business\Expander\CategoryTransfer;

use App\Backend\DataSource\Entity\Category;
use App\Shared\Generated\DTO\Category\CategoryTransfer;

class CategoryTransferExpander implements CategoryTransferExpanderInterface
{
    /**
     * @param iterable<ExpanderInterface> $expanders
     * @param Category|null $category
     */
    public function __construct(
        private readonly iterable $expanders,
        private readonly ?Category $category,
    )
    {
    }

    /**
     * @param CategoryTransfer $categoryTransfer
     *
     * @return void
     */
    public function expand(CategoryTransfer $categoryTransfer): void
    {
        foreach ($this->expanders as $expander) {
            $expander->expand($categoryTransfer, $this->category);
        }
    }
}
<?php

namespace App\Backend\Category\Business\Expander\CategoryTransfer;

use App\Backend\DataSource\Entity\Category;

class CategoryTransferExpanderFactory implements CategoryTransferExpanderFactoryInterface
{
    /**
     * @param iterable $expanderCollection
     */
    public function __construct(private readonly iterable $expanderCollection)
    {
    }

    /**
     * @param Category|null $category
     *
     * @return CategoryTransferExpanderInterface
     */
    public function create(?Category $category = null): CategoryTransferExpanderInterface
    {
        return new CategoryTransferExpander($this->expanderCollection, $category);
    }
}
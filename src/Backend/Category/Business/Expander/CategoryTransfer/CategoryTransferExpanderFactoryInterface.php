<?php

namespace App\Backend\Category\Business\Expander\CategoryTransfer;

use App\Backend\DataSource\Entity\Category;

interface CategoryTransferExpanderFactoryInterface
{
    /**
     * @param Category|null $category
     *
     * @return CategoryTransferExpanderInterface
     */
    public function create(?Category $category = null): CategoryTransferExpanderInterface;
}
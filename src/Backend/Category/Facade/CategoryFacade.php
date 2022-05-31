<?php

namespace App\Backend\Category\Facade;

use App\Backend\Category\Business\Factory\CategoryFactoryInterface;
use App\Shared\Category\Facade\CategoryFacadeInterface;
use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;
use App\Shared\Generated\DTO\Category\CategoryTransfer;

class CategoryFacade implements CategoryFacadeInterface
{

    public function __construct(private readonly CategoryFactoryInterface $categoryFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createCategory(CategoryCreateTransfer $categoryCreateTransfer): CategoryTransfer
    {
        return $this->categoryFactory->create($categoryCreateTransfer);
    }

    public function lookup()
    {
        // TODO: Implement lookup() method.
    }
}
<?php

namespace App\Backend\Category\Facade;

use App\Backend\Category\Business\Factory\CategoryFactoryInterface;
use App\Shared\Category\Facade\CategoryFacadeInterface;
use App\Shared\Generated\DTO\Category\CategoryTransfer;
use App\Shared\Generated\DTO\Category\CreateCategoryTransfer;

class CategoryFacade implements CategoryFacadeInterface
{

    public function __construct(private readonly CategoryFactoryInterface $categoryFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createCategory(CreateCategoryTransfer $createCategoryTransfer): CategoryTransfer
    {
        return $this->categoryFactory->create($createCategoryTransfer);
    }

    public function lookup()
    {
        // TODO: Implement lookup() method.
    }
}
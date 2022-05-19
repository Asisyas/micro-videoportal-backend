<?php

namespace App\Client\Category\Facade;

use App\Client\Category\Business\Reader\CategoryReaderFactoryInterface;
use App\Shared\Generated\DTO\Category\CategoryGetRequestTransfer;
use App\Shared\Generated\DTO\Category\CategoryGetResponseTransfer;

class CategoryClientFacade implements CategoryClientFacadeInterface
{
    /**
     * @param CategoryReaderFactoryInterface $categoryReaderFactory
     */
    public function __construct(private readonly CategoryReaderFactoryInterface $categoryReaderFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function lookup(CategoryGetRequestTransfer $categoryGetRequestTransfer): CategoryGetResponseTransfer
    {
        return $this->categoryReaderFactory->create()->lookup($categoryGetRequestTransfer);
    }
}
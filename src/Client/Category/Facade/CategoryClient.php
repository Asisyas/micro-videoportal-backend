<?php

namespace App\Client\Category\Facade;

use App\Client\Category\Business\Manager\CategoryManagerFactoryInterface;
use App\Client\Category\Business\Reader\CategoryReaderFactoryInterface;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;
use App\Shared\Generated\DTO\Category\CategoryGetRequestTransfer;
use App\Shared\Generated\DTO\Category\CategoryGetResponseTransfer;

class CategoryClient implements CategoryClientInterface
{
    /**
     * @param CategoryReaderFactoryInterface $categoryReaderFactory
     * @param CategoryManagerFactoryInterface $categoryManagerFactory
     */
    public function __construct(
        private readonly CategoryReaderFactoryInterface $categoryReaderFactory,
        private readonly CategoryManagerFactoryInterface $categoryManagerFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function lookup(CategoryGetRequestTransfer $categoryGetRequestTransfer): CategoryGetResponseTransfer
    {
        return $this->categoryReaderFactory->create()->lookup($categoryGetRequestTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function create(CategoryCreateTransfer $categoryCreateTransfer): ResponseTransfer
    {
        return $this->categoryManagerFactory->create()->create($categoryCreateTransfer);
    }
}
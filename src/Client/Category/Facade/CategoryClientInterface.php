<?php

namespace App\Client\Category\Facade;


use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;
use App\Shared\Generated\DTO\Category\CategoryGetRequestTransfer;
use App\Shared\Generated\DTO\Category\CategoryGetResponseTransfer;

interface CategoryClientInterface
{
    /**
     * @param CategoryGetRequestTransfer $categoryGetRequestTransfer
     * @return CategoryGetResponseTransfer
     */
    public function lookup(CategoryGetRequestTransfer $categoryGetRequestTransfer): CategoryGetResponseTransfer;

    /**
     * @param CategoryCreateTransfer $categoryCreateTransfer
     *
     * @return ResponseTransfer
     */
    public function create(CategoryCreateTransfer $categoryCreateTransfer): ResponseTransfer;
}
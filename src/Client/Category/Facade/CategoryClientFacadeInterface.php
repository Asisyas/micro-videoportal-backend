<?php

namespace App\Client\Category\Facade;


use App\Shared\Generated\DTO\Category\CategoryGetRequestTransfer;
use App\Shared\Generated\DTO\Category\CategoryGetResponseTransfer;

interface CategoryClientFacadeInterface
{
    /**
     * @param CategoryGetRequestTransfer $categoryGetRequestTransfer
     * @return CategoryGetResponseTransfer
     */
    public function lookup(CategoryGetRequestTransfer $categoryGetRequestTransfer): CategoryGetResponseTransfer;
}
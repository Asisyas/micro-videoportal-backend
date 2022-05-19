<?php

namespace App\Client\Category\Business\Reader;

use App\Shared\Generated\DTO\Category\CategoryGetRequestTransfer;
use App\Shared\Generated\DTO\Category\CategoryGetResponseTransfer;


interface CategoryReaderInterface
{
    /**
     * @param CategoryGetRequestTransfer $categoryGetRequestTransfer
     * @return CategoryGetResponseTransfer
     */
    public function lookup(CategoryGetRequestTransfer $categoryGetRequestTransfer): CategoryGetResponseTransfer;
}
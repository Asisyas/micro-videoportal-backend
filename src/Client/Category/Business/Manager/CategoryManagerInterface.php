<?php

namespace App\Client\Category\Business\Manager;

use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;

interface CategoryManagerInterface
{
    /**
     * @param CategoryCreateTransfer $categoryCreateTransfer
     *
     * @return ResponseTransfer
     */
    public function create(CategoryCreateTransfer $categoryCreateTransfer): ResponseTransfer;
}
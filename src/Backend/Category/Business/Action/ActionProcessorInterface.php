<?php

namespace App\Backend\Category\Business\Action;

use App\Shared\Generated\DTO\Category\CategoryTransfer;

interface ActionProcessorInterface
{
    /**
     * @param CategoryTransfer $categoryTransfer
     *
     * @return void
     */
    public function process(CategoryTransfer $categoryTransfer): void;
}
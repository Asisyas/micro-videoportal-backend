<?php

namespace App\Backend\SearchStorage\Facade;

use App\Shared\Generated\DTO\Search\IndexAddTransfer;

interface SearchStorageFacadeInterface
{
    /**
     * @param IndexAddTransfer $indexAddTransfer
     *
     * @return void
     */
    public function index(IndexAddTransfer $indexAddTransfer): void;
}
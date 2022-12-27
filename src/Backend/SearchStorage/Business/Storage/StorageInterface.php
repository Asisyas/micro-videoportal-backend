<?php

namespace App\Backend\SearchStorage\Business\Storage;

use App\Shared\Generated\DTO\Search\IndexAddTransfer;

interface StorageInterface
{
    /**
     * @param IndexAddTransfer $indexAddTransfer
     *
     * @return void
     */
    public function index(IndexAddTransfer $indexAddTransfer): void;
}

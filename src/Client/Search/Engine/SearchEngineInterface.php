<?php

namespace App\Client\Search\Engine;

use App\Shared\Generated\DTO\Search\SearchTransfer;

interface SearchEngineInterface
{
    /**
     * @param SearchTransfer $searchTransfer
     *
     * @return mixed
     */
    public function search(SearchTransfer $searchTransfer): mixed;
}
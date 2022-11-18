<?php

namespace App\Client\Search\Client;

use App\Shared\Generated\DTO\Search\SearchTransfer;

interface SearchClientInterface
{
    /**
     * @param SearchTransfer $searchTransfer
     *
     * @return mixed
     */
    public function search(SearchTransfer $searchTransfer): mixed;
}
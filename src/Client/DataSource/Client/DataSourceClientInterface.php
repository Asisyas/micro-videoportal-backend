<?php

namespace App\Client\DataSource\Client;

use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

interface DataSourceClientInterface
{
    /**
     * @param string $uuid
     *
     * @return DataSourceTransfer
     */
    public function lookup(string $uuid): DataSourceTransfer;
}
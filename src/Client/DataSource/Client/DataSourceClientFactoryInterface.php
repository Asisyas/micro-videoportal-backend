<?php

namespace App\Client\DataSource\Client;

interface DataSourceClientFactoryInterface
{
    /**
     * @return DataSourceClientInterface
     */
    public function create(): DataSourceClientInterface;
}
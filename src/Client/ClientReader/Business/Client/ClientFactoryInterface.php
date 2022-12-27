<?php

namespace App\Client\ClientReader\Business\Client;

interface ClientFactoryInterface
{
    /**
     * @return ClientInterface
     */
    public function create(): ClientInterface;
}

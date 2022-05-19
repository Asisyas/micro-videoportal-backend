<?php

namespace App\Backend\ClientStorage\Business\Client;

interface ClientFactoryInterface
{
    /**
     * @return ClientInterface
     */
    public function create(): ClientInterface;
}
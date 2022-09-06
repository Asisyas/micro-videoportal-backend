<?php

namespace App\Client\Amqp\Rpc;

interface RpcFactoryInterface
{
    /**
     * @return RpcInterface
     */
    public function create(): RpcInterface;
}
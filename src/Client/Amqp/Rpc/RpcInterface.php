<?php

namespace App\Client\Amqp\Rpc;

use App\Shared\Generated\DTO\Amqp\RpcRequestTransfer;

interface RpcInterface
{
    /**
     * @param RpcRequestTransfer $request
     *
     * @return mixed
     */
    public function call(RpcRequestTransfer $request): mixed;
}
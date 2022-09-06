<?php

namespace App\Client\Amqp\Client;

use App\Shared\Generated\DTO\Amqp\RequestTransfer;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use App\Shared\Generated\DTO\Amqp\RpcRequestTransfer;
use App\Shared\Generated\DTO\Amqp\TaskStatusRequestTransfer;
use App\Shared\Generated\DTO\Amqp\TaskStatusResponseTransfer;

interface AmqpClientInterface
{
    /**
     * @param RequestTransfer $requestTransfer
     *
     * @return ResponseTransfer
     */
    public function publish(RequestTransfer $requestTransfer): ResponseTransfer;

    /**
     * @param TaskStatusRequestTransfer $taskStatusRequestTransfer
     *
     * @return TaskStatusResponseTransfer
     */
    public function receiveStatus(TaskStatusRequestTransfer $taskStatusRequestTransfer): TaskStatusResponseTransfer;

    /**
     * @param RpcRequestTransfer $request
     *
     * @return mixed
     */
    public function rpc(RpcRequestTransfer $request): mixed;
}
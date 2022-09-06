<?php

namespace App\Client\Amqp\Client;

use App\Client\Amqp\Publisher\PublisherFactoryInterface;
use App\Client\Amqp\Receiver\ReceiverFactoryInterface;
use App\Client\Amqp\Rpc\RpcFactoryInterface;
use App\Shared\Generated\DTO\Amqp\RequestTransfer;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use App\Shared\Generated\DTO\Amqp\RpcRequestTransfer;
use App\Shared\Generated\DTO\Amqp\TaskStatusRequestTransfer;
use App\Shared\Generated\DTO\Amqp\TaskStatusResponseTransfer;

class AmqpClient implements AmqpClientInterface
{
    /**
     * @param PublisherFactoryInterface $publisherFactory
     * @param ReceiverFactoryInterface $receiverFactory
     * @param RpcFactoryInterface $rpcFactory
     */
    public function __construct(
        private readonly PublisherFactoryInterface $publisherFactory,
        private readonly ReceiverFactoryInterface $receiverFactory,
        private readonly RpcFactoryInterface $rpcFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function publish(RequestTransfer $requestTransfer): ResponseTransfer
    {
        return $this->publisherFactory->create()->publish($requestTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function receiveStatus(TaskStatusRequestTransfer $taskStatusRequestTransfer): TaskStatusResponseTransfer
    {
        return $this->receiverFactory->create()->receive($taskStatusRequestTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function rpc(RpcRequestTransfer $request): mixed
    {
        return $this->rpcFactory
            ->create()
            ->call($request);
    }

}
<?php

namespace App\Client\Amqp\Rpc;

use App\Shared\Generated\DTO\Amqp\RpcRequestTransfer;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Amqp\AmqpFacadeInterface;
use Micro\Plugin\Amqp\Business\Message\MessageRpc;
use Micro\Plugin\Uuid\UuidFacadeInterface;

class Rpc implements RpcInterface
{
    public function __construct(
        private readonly UuidFacadeInterface $uuidFacade,
        private readonly AmqpFacadeInterface $amqpFacade,
        private readonly SerializerFacadeInterface $serializerFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function call(RpcRequestTransfer $request): mixed
    {

        $messageRpc = new MessageRpc(
            $this->uuidFacade->v4(),
            $this->serializerFacade->toJsonTransfer($request->getMessage()),
            $request->getPublisher()
        );

        $rpcResponse = $this->serializerFacade->fromJsonTransfer($this->amqpFacade->rpc($messageRpc));

        return $rpcResponse;
    }
}
<?php

namespace App\Client\Amqp\Publisher;

use App\Shared\Generated\DTO\Amqp\RequestTransfer;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use Micro\Library\DTO\Object\AbstractDto;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Amqp\AmqpFacadeInterface;
use Micro\Plugin\Amqp\Business\Message\Message;
use Micro\Plugin\Uuid\UuidFacadeInterface;

class Publisher implements PublisherInterface
{
    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param AmqpFacadeInterface $amqpFacade
     * @param SerializerFacadeInterface $serializerFacade
     */
    public function __construct(
        private readonly UuidFacadeInterface $uuidFacade,
        private readonly AmqpFacadeInterface $amqpFacade,
        private readonly SerializerFacadeInterface $serializerFacade
    ) {}

    /**
     * {@inheritDoc}
     */
    public function publish(RequestTransfer $requestTransfer): ResponseTransfer
    {
        $message = new Message(
            $this->uuidFacade->v4(),
            $this->createMessage($requestTransfer)
        );

        $this->amqpFacade->publish($message, $requestTransfer->getPublisher());

        return $this->createResponse($message);
    }

    /**
     * @param Message $message
     *
     * @return ResponseTransfer
     */
    protected function createResponse(Message $message): ResponseTransfer
    {
        $response = new ResponseTransfer();
        $response->setChannelId($message->getId());

        return $response;
    }

    /**
     * @param RequestTransfer $requestTransfer
     *
     * @return string
     */
    protected function createMessage(RequestTransfer $requestTransfer): string
    {
        $messageObject = $requestTransfer->getMessage();

        if(!($messageObject instanceof AbstractDto)) {
            throw new \RuntimeException(
                sprintf(
                    '%s::%s should be returned object instance of %s. %s given.',
                    RequestTransfer::class, 'getMessage()',
                    AbstractDto::class,
                    is_scalar($messageObject) ? gettype($messageObject) : get_class($messageObject)
                )
            );
        }

        return $this->serializerFacade->toJsonTransfer($messageObject);
    }
}
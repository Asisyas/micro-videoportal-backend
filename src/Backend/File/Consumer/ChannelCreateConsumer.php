<?php

namespace App\Backend\File\Consumer;

use App\Backend\File\Facade\FileFacadeInterface;
use App\Shared\File\Configuration;
use App\Shared\Generated\DTO\File\CredentialsRequestTransfer;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Amqp\Business\Consumer\ConsumerProcessorInterface;
use Micro\Plugin\Amqp\Business\Message\MessageReceivedInterface;

class ChannelCreateConsumer implements ConsumerProcessorInterface
{
    /**
     * @param FileFacadeInterface $fileFacade
     * @param SerializerFacadeInterface $serializerFacade
     */
    public function __construct(
        private readonly FileFacadeInterface $fileFacade,
        private readonly SerializerFacadeInterface $serializerFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function receive(MessageReceivedInterface $message): bool
    {
        /** @var CredentialsRequestTransfer $credentialsRequestTransfer */
        $credentialsRequestTransfer = $this->serializerFacade->fromJsonTransfer($message->content()->getContent());
        $result = $this->fileFacade->createChannel($credentialsRequestTransfer);
        $resultContent = $this->serializerFacade->toJsonTransfer($result);
        $message->content()->setResultContent($resultContent);

        $message->ack();

        return true;
    }

    /**
     * @return string
     */
    public static function name(): string
    {
        return Configuration::CONSUMER_CHANNEL_CREATE_NAME;
    }
}
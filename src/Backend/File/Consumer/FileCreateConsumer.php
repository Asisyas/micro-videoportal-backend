<?php

namespace App\Backend\File\Consumer;

use App\Backend\File\Facade\FileFacadeInterface;
use App\Shared\File\Configuration;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Amqp\AmqpFacadeInterface;
use Micro\Plugin\Amqp\Business\Consumer\ConsumerProcessorInterface;
use Micro\Plugin\Amqp\Business\Message\MessageReceivedInterface;

class FileCreateConsumer implements ConsumerProcessorInterface
{
    /**
     * @param FileFacadeInterface $fileFacade
     * @param SerializerFacadeInterface $serializerFacade
     * @param AmqpFacadeInterface $amqpFacade
     */
    public function __construct(
        private readonly FileFacadeInterface $fileFacade,
        private readonly SerializerFacadeInterface $serializerFacade,
        private readonly AmqpFacadeInterface $amqpFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function receive(MessageReceivedInterface $message): void
    {
        /** @var FileUploadTransfer $fileUploadTransfer */
        $fileUploadTransfer = $this->serializerFacade->fromJsonTransfer($message->content()->getContent());
        $result = $this->fileFacade->createFile($fileUploadTransfer);
        $resultContent = $this->serializerFacade->toJsonTransfer($result);
        $message->content()->setResultContent($resultContent);

        $this->amqpFacade->publish(
            $message->content(),
            self::name(),
            'rpc_response',
            [
                'correlation_id'    => $message->getOption('correlation_id'),
            ]
        );

        $message->ack();
    }

    /**
     * @return string
     */
    public static function name(): string
    {
        return Configuration::CONSUMER_FILE_CREATE_NAME;
    }
}
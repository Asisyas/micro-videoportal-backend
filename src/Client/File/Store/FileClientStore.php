<?php

namespace App\Client\File\Store;

use App\Client\Amqp\Client\AmqpClientInterface;
use App\Shared\File\Configuration;
use App\Shared\Generated\DTO\Amqp\RpcRequestTransfer;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;

class FileClientStore implements FileClientStoreInterface
{
    /**
     * @param AmqpClientInterface $amqpClient
     */
    public function __construct(
        private readonly AmqpClientInterface $amqpClient
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createFile(FileCreateTransfer $fileCreateTransfer): FileTransfer
    {
        $request = new RpcRequestTransfer();

        $request->setMessage($fileCreateTransfer);
        $request->setPublisher(Configuration::PUBLISHER_FILE_CREATE_NAME);

        /** @var FileTransfer $response */
        $response = $this->amqpClient->rpc($request);

        return $response;
    }
}
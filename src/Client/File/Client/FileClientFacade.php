<?php

namespace App\Client\File\Client;

use App\Client\Amqp\Client\AmqpClientInterface;
use App\Client\File\FileClientInterface;
use App\Shared\File\Configuration;
use App\Shared\Generated\DTO\Amqp\RequestTransfer;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use App\Shared\Generated\DTO\File\CredentialsRequestTransfer;
use Micro\Plugin\Redis\Redis\RedisInterface;

class FileClientFacade implements FileClientInterface
{
    /**
     * @param AmqpClientInterface $amqpClient
     * @param RedisInterface $redis
     */
    public function __construct(
        private readonly AmqpClientInterface $amqpClient,
        protected readonly RedisInterface $redis
    )
    {
    }

    /**
     * @param CredentialsRequestTransfer $fileCredentialsTransfer
     *
     * @return ResponseTransfer
     */
    public function createChannel(CredentialsRequestTransfer $fileCredentialsTransfer): ResponseTransfer
    {
        $request = new RequestTransfer();
        $request->setMessage($fileCredentialsTransfer);
        $request->setPublisher(Configuration::PUBLISHER_CHANNEL_CREATE_NAME);

        return $this->amqpClient->publish($request);
    }

}
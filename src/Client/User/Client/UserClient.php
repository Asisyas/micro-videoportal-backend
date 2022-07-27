<?php

namespace App\Client\User\Client;

use App\Client\Amqp\Client\AmqpClientInterface;
use App\Client\User\UserClientInterface;
use App\Shared\Generated\DTO\Amqp\RequestTransfer;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use App\Shared\Generated\DTO\User\UserCreateTransfer;
use App\Shared\User\Configuration;

class UserClient implements UserClientInterface
{

    public function __construct(private readonly AmqpClientInterface $amqpClient)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createUser(UserCreateTransfer $userCreateTransfer): ResponseTransfer
    {
        $request = new RequestTransfer();
        $request->setPublisher(Configuration::AMQP_PUBLISHER_USER_CREATE);
        $request->setMessage($userCreateTransfer);

        return $this->amqpClient->publish($request);
    }
}
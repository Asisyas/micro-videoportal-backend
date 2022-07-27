<?php

namespace App\Client\User;

use App\Shared\Generated\DTO\User\UserCreateTransfer;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;

interface UserClientInterface
{
    /**
     * @param UserCreateTransfer $userCreateTransfer
     *
     * @return ResponseTransfer
     */
    public function createUser(UserCreateTransfer $userCreateTransfer): ResponseTransfer;
}
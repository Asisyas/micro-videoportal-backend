<?php

namespace App\Backend\User\Business\Factory;

use App\Shared\Generated\DTO\User\UserCreateTransfer;
use App\Shared\Generated\DTO\User\UserTransfer;

interface UserFactoryInterface
{
    /**
     * @param UserCreateTransfer $userCreateTransfer
     *
     * @return UserTransfer
     */
    public function create(UserCreateTransfer $userCreateTransfer): UserTransfer;
}
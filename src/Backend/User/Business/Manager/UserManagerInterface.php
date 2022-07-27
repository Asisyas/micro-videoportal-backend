<?php

namespace App\Backend\User\Business\Manager;

use App\Shared\Generated\DTO\User\UserCreateTransfer;
use App\Shared\Generated\DTO\User\UserTransfer;

interface UserManagerInterface
{
    /**
     * @param UserCreateTransfer $userCreateTransfer
     *
     * @return UserTransfer
     */
    public function createUser(UserCreateTransfer $userCreateTransfer): UserTransfer;
}
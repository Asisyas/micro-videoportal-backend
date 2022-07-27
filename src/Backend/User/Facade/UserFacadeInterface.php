<?php

namespace App\Backend\User\Facade;

use App\Shared\Generated\DTO\User\UserCreateTransfer;
use App\Shared\Generated\DTO\User\UserTransfer;

interface UserFacadeInterface
{
    /**
     * @param UserCreateTransfer $createTransfer
     *
     * @return UserTransfer
     */
    public function createUser(UserCreateTransfer $createTransfer): UserTransfer;
}
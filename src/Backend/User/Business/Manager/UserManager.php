<?php

namespace App\Backend\User\Business\Manager;

use App\Backend\User\Business\Factory\UserFactoryInterface;
use App\Shared\Generated\DTO\User\UserCreateTransfer;
use App\Shared\Generated\DTO\User\UserTransfer;

class UserManager implements UserManagerInterface
{
    /**
     * @param UserFactoryInterface $userFactory
     */
    public function __construct(private readonly UserFactoryInterface $userFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createUser(UserCreateTransfer $userCreateTransfer): UserTransfer
    {
        return $this->userFactory->create($userCreateTransfer);
    }
}
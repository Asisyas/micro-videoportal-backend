<?php

namespace App\Backend\User\Facade;

use App\Backend\User\Business\Manager\UserManagerFactoryInterface;
use App\Shared\Generated\DTO\User\UserCreateTransfer;
use App\Shared\Generated\DTO\User\UserTransfer;

class UserFacade implements UserFacadeInterface
{
    /**
     * @param UserManagerFactoryInterface $userManagerFactory
     */
    public function __construct(private readonly UserManagerFactoryInterface $userManagerFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createUser(UserCreateTransfer $createTransfer): UserTransfer
    {
        return $this->userManagerFactory->create()->createUser($createTransfer);
    }
}
<?php

namespace App\Backend\User\Business\Manager;

use App\Backend\User\Business\Factory\UserFactoryInterface;

class UserManagerFactory implements UserManagerFactoryInterface
{
    /**
     * @param UserFactoryInterface $userFactory
     */
    public function __construct(private readonly UserFactoryInterface $userFactory)
    {
    }

    /**
     * @return UserManagerInterface
     */
    public function create(): UserManagerInterface
    {
        return new UserManager(
            $this->userFactory
        );
    }
}
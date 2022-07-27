<?php

namespace App\Backend\User\Business\Manager;

interface UserManagerFactoryInterface
{
    /**
     * @return UserManagerInterface
     */
    public function create(): UserManagerInterface;
}
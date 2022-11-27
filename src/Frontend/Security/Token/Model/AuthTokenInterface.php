<?php

namespace App\Frontend\Security\Token\Model;

use Micro\Plugin\Security\Token\TokenInterface;

interface AuthTokenInterface extends TokenInterface
{
    const PARAM_USER_ID = 'uuid';
    const PARAM_ROLES = 'roles';

    /**
     * @return string|null
     */
    public function getUserId(): null|string;

    /**
     * @return array
     */
    public function getRoles(): array;
}
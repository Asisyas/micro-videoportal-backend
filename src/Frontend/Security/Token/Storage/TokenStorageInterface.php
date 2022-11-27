<?php

namespace App\Frontend\Security\Token\Storage;

use App\Frontend\Security\Token\Model\AuthTokenInterface;

interface TokenStorageInterface
{
    /**
     * @return AuthTokenInterface
     */
    public function getAuthToken(): AuthTokenInterface;
}
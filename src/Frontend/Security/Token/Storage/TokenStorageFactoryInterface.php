<?php

namespace App\Frontend\Security\Token\Storage;

use App\Frontend\Security\Token\Model\AuthTokenInterface;

interface TokenStorageFactoryInterface
{
    /**
     * @param AuthTokenInterface $authToken
     *
     * @return TokenStorageInterface
     */
    public function create(AuthTokenInterface $authToken): TokenStorageInterface;
}

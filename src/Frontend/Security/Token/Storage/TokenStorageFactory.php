<?php

namespace App\Frontend\Security\Token\Storage;

use App\Frontend\Security\Token\Model\AuthTokenInterface;

class TokenStorageFactory implements TokenStorageFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(AuthTokenInterface $authToken): TokenStorageInterface
    {
        return new TokenStorage($authToken);
    }
}
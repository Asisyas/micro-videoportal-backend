<?php

namespace App\Frontend\Security\Token\Storage;

use App\Frontend\Security\Token\Model\AuthTokenInterface;

class TokenStorage implements TokenStorageInterface
{
    /**
     * @param AuthTokenInterface $authToken
     */
    public function __construct(
        private readonly AuthTokenInterface $authToken
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthToken(): AuthTokenInterface
    {
        return $this->authToken;
    }
}

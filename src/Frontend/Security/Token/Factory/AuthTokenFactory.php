<?php

namespace App\Frontend\Security\Token\Factory;

use App\Frontend\Security\Token\Model\AuthToken;
use App\Frontend\Security\Token\Model\AuthTokenInterface;
use App\Shared\Generated\DTO\Security\TokenTransfer;

class AuthTokenFactory implements AuthTokenFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(TokenTransfer $token): AuthTokenInterface
    {
        return new AuthToken($token);
    }
}

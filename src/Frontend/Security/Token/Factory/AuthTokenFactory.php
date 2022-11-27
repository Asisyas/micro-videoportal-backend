<?php

namespace App\Frontend\Security\Token\Factory;

use App\Frontend\Security\Token\Model\AuthToken;
use App\Frontend\Security\Token\Model\AuthTokenInterface;
use Micro\Plugin\Security\Token\TokenInterface;

class AuthTokenFactory implements AuthTokenFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(TokenInterface $token): AuthTokenInterface
    {
        return new AuthToken($token);
    }
}
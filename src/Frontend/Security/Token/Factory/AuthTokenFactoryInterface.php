<?php

namespace App\Frontend\Security\Token\Factory;

use App\Frontend\Security\Token\Model\AuthTokenInterface;
use App\Shared\Generated\DTO\Security\TokenTransfer;

interface AuthTokenFactoryInterface
{
    /**
     * @param TokenTransfer $token
     *
     * @return AuthTokenInterface
     */
    public function create(TokenTransfer $token): AuthTokenInterface;
}

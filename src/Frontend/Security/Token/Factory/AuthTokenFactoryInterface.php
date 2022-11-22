<?php

namespace App\Frontend\Security\Token\Factory;

use App\Frontend\Security\Token\Model\AuthTokenInterface;
use Micro\Plugin\Security\Token\TokenInterface;

interface AuthTokenFactoryInterface
{
    /**
     * @param TokenInterface $token
     *
     * @return AuthTokenInterface
     */
    public function create(TokenInterface $token): AuthTokenInterface;
}
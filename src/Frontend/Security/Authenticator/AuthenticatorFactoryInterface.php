<?php

namespace App\Frontend\Security\Authenticator;

interface AuthenticatorFactoryInterface
{
    /**
     * @return AuthenticatorInterface
     */
    public function create(): AuthenticatorInterface;
}

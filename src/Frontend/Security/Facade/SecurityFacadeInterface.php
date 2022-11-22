<?php

namespace App\Frontend\Security\Facade;

use App\Frontend\Security\Authenticator\AuthenticatorInterface;
use App\Frontend\Security\Token\Storage\TokenStorageInterface;

interface SecurityFacadeInterface extends AuthenticatorInterface, TokenStorageInterface
{
}
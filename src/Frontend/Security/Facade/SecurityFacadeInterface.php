<?php

namespace App\Frontend\Security\Facade;

use App\Frontend\Security\Authenticator\AuthenticatorInterface;
use App\Frontend\Security\Token\Storage\TokenStorageInterface;
use App\Shared\Generated\DTO\Security\AuthConfigurationTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
interface SecurityFacadeInterface extends
    AuthenticatorInterface,
    TokenStorageInterface
{
    /**
     * @return AuthConfigurationTransfer
     */
    public function getAuthConfiguration(): AuthConfigurationTransfer;
}

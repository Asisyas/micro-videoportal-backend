<?php

namespace App\Frontend\Security\Authenticator;

use App\Client\Security\Client\ClientSecurityInterface;
use App\Frontend\Security\Configuration\SecurityPluginConfigurationInterface;
use App\Frontend\Security\Token\Factory\AuthTokenFactoryInterface;

class HeaderAuthenticatorFactory implements AuthenticatorFactoryInterface
{
    /**
     * @param ClientSecurityInterface               $securityClient
     * @param AuthTokenFactoryInterface             $authTokenFactory
     * @param SecurityPluginConfigurationInterface  $pluginConfiguration
     */
    public function __construct(
        private readonly ClientSecurityInterface              $securityClient,
        private readonly AuthTokenFactoryInterface            $authTokenFactory,
        private readonly SecurityPluginConfigurationInterface $pluginConfiguration
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): AuthenticatorInterface
    {
        return new HeaderAuthenticator(
            $this->securityClient,
            $this->authTokenFactory,
            $this->pluginConfiguration
        );
    }
}

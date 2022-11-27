<?php

namespace App\Frontend\Security\Authenticator;

use App\Frontend\Security\Configuration\SecurityPluginConfigurationInterface;
use App\Frontend\Security\Token\Factory\AuthTokenFactoryInterface;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;

class HeaderAuthenticatorFactory implements AuthenticatorFactoryInterface
{
    /**
     * @param SecurityFacadeInterface $securityFacade
     * @param AuthTokenFactoryInterface $authTokenFactory
     * @param SecurityPluginConfigurationInterface $pluginConfiguration
     */
    public function __construct(
        private readonly SecurityFacadeInterface $securityFacade,
        private readonly AuthTokenFactoryInterface $authTokenFactory,
        private readonly SecurityPluginConfigurationInterface $pluginConfiguration
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): AuthenticatorInterface
    {
        return new HeaderAuthenticator(
            $this->securityFacade,
            $this->authTokenFactory,
            $this->pluginConfiguration
        );
    }
}
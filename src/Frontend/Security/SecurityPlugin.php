<?php

namespace App\Frontend\Security;

use App\Client\Security\Client\SecurityClientInterface;
use App\Frontend\Security\AuthConfig\AuthConfigurationFactory;
use App\Frontend\Security\AuthConfig\AuthConfigurationFactoryInterface;
use App\Frontend\Security\AuthConfig\Expander\AuthConfigTransferExpanderFactory;
use App\Frontend\Security\AuthConfig\Expander\AuthConfigTransferExpanderFactoryInterface;
use App\Frontend\Security\AuthConfig\Expander\Impl\OAuth2Expander;
use App\Frontend\Security\Authenticator\AuthenticatorFactoryInterface;
use App\Frontend\Security\Authenticator\HeaderAuthenticatorFactory;
use App\Frontend\Security\Configuration\SecurityPluginConfigurationInterface;
use App\Frontend\Security\Facade\SecurityFacade;
use App\Frontend\Security\Facade\SecurityFacadeInterface;
use App\Frontend\Security\Token\Factory\AuthTokenFactory;
use App\Frontend\Security\Token\Factory\AuthTokenFactoryInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Plugin\OAuth2\Client\Facade\Oauth2ClientFacadeInterface;

/**
 * @method SecurityPluginConfigurationInterface configuration()
 */
class SecurityPlugin implements ConfigurableInterface, DependencyProviderInterface
{
    use PluginConfigurationTrait;

    /**
     * @var SecurityClientInterface
     */
    private readonly SecurityClientInterface $securityClient;

    /**
     * @var Oauth2ClientFacadeInterface
     */
    private readonly Oauth2ClientFacadeInterface $oauth2ClientFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(SecurityFacadeInterface::class, function (
            SecurityClientInterface     $securityClient,
            Oauth2ClientFacadeInterface $oauth2ClientFacade
        ) {
            $this->securityClient       = $securityClient;
            $this->oauth2ClientFacade   = $oauth2ClientFacade;

            return $this->createFacade();
        });
    }

    protected function createFacade(): SecurityFacade
    {
        return new SecurityFacade(
            $this->createAuthenticatorFactory(),
            $this->createAuthConfigurationFactory(),
        );
    }

    protected function createAuthConfigurationFactory(): AuthConfigurationFactory
    {
        return new AuthConfigurationFactory(
            $this->createAuthConfigExpanderFactory()
        );
    }

    protected function createAuthConfigExpanderFactory(): AuthConfigTransferExpanderFactory
    {
        return new AuthConfigTransferExpanderFactory(
            new OAuth2Expander($this->oauth2ClientFacade)
        );
    }

    protected function createAuthenticatorFactory(): HeaderAuthenticatorFactory
    {
        return new HeaderAuthenticatorFactory(
            $this->securityClient,
            $this->createAuthTokenFactory(),
            $this->configuration()
        );
    }

    protected function createAuthTokenFactory(): AuthTokenFactory
    {
        return new AuthTokenFactory();
    }

    public function name(): string
    {
        return 'SecurityPluginFrontend';
    }
}

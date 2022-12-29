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

    /**
     * @return SecurityFacadeInterface
     */
    protected function createFacade(): SecurityFacadeInterface
    {
        return new SecurityFacade(
            $this->createAuthenticatorFactory(),
            $this->createAuthConfigurationFactory(),
        );
    }

    /**
     * @return AuthConfigurationFactoryInterface
     */
    protected function createAuthConfigurationFactory(): AuthConfigurationFactoryInterface
    {
        return new AuthConfigurationFactory(
            $this->createAuthConfigExpanderFactory()
        );
    }

    /**
     * @return AuthConfigTransferExpanderFactoryInterface
     */
    protected function createAuthConfigExpanderFactory(): AuthConfigTransferExpanderFactoryInterface
    {
        return new AuthConfigTransferExpanderFactory(
            new OAuth2Expander($this->oauth2ClientFacade)
        );
    }

    /**
     * @return AuthenticatorFactoryInterface
     */
    protected function createAuthenticatorFactory(): AuthenticatorFactoryInterface
    {
        return new HeaderAuthenticatorFactory(
            $this->securityClient,
            $this->createAuthTokenFactory(),
            $this->configuration()
        );
    }

    /**
     * @return AuthTokenFactoryInterface
     */
    protected function createAuthTokenFactory(): AuthTokenFactoryInterface
    {
        return new AuthTokenFactory();
    }

    public function name(): string
    {
        return 'SecurityPluginFrontend';
    }
}

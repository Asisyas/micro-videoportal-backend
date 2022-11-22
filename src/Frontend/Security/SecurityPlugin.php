<?php

namespace App\Frontend\Security;

use App\Frontend\Security\Authenticator\AuthenticatorFactoryInterface;
use App\Frontend\Security\Authenticator\HeaderAuthenticatorFactory;
use App\Frontend\Security\Configuration\SecurityPluginConfigurationInterface;
use App\Frontend\Security\Facade\SecurityFacade;
use App\Frontend\Security\Facade\SecurityFacadeInterface;
use App\Frontend\Security\Token\Factory\AuthTokenFactory;
use App\Frontend\Security\Token\Factory\AuthTokenFactoryInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface as JWTSecurityFacadeInterface;

/**
 * @method SecurityPluginConfigurationInterface configuration()
 */
class SecurityPlugin extends AbstractPlugin
{
    /**
     * @var JWTSecurityFacadeInterface
     */
    private readonly JWTSecurityFacadeInterface $securityFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(SecurityFacadeInterface::class, function (
            JWTSecurityFacadeInterface $securityFacade
        ) {
            $this->securityFacade = $securityFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return SecurityFacadeInterface
     */
    protected function createFacade(): SecurityFacadeInterface
    {
        return new SecurityFacade(
            $this->createAuthenticatorFactory()
        );
    }

    /**
     * @return AuthenticatorFactoryInterface
     */
    protected function createAuthenticatorFactory(): AuthenticatorFactoryInterface
    {
        return new HeaderAuthenticatorFactory(
            $this->securityFacade,
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
}
<?php

declare(strict_types=1);

/**
 * This file is part of the Micro framework package.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Client\Security;

use App\Client\Security\Authorization\AuthorizationManagerFactory;
use App\Client\Security\Authorization\AuthorizationManagerFactoryInterface;
use App\Client\Security\Authorization\Expander\Impl\TokenData\DefaultExpander as TokenDataExpanderDefault;
use App\Client\Security\Authorization\Expander\Impl\TokenData\OwnerExpander as TokenDataExpanderOwner;
use App\Client\Security\Authorization\Expander\Impl\TokenTransfer\DefaultExpander as TokenTransferExpanderDefault;
use App\Client\Security\Authorization\Expander\Impl\TokenTransfer\OwnerExpander as TokenTransferExpanderOwner;
use App\Client\Security\Authorization\Expander\SecurityTokenDataExpanderFactory;
use App\Client\Security\Authorization\Expander\SecurityTokenDataExpanderFactoryInterface;
use App\Client\Security\Authorization\Expander\TokenTransferExpanderFactory;
use App\Client\Security\Authorization\Expander\TokenTransferExpanderFactoryInterface;
use App\Client\Security\Client\SecurityClient;
use App\Client\Security\Client\SecurityClientInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Plugin\OAuth2\Client\Facade\Oauth2ClientFacadeInterface;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class SecurityClientPlugin implements DependencyProviderInterface
{
    /**
     * @var SecurityFacadeInterface
     */
    private readonly SecurityFacadeInterface $securityFacade;

    /**
     * @var Oauth2ClientFacadeInterface
     */
    private readonly Oauth2ClientFacadeInterface $oauth2ClientFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(SecurityClientInterface::class, function (
            SecurityFacadeInterface     $securityFacade,
            Oauth2ClientFacadeInterface $oauth2ClientFacade
        ) {
            $this->securityFacade       = $securityFacade;
            $this->oauth2ClientFacade   = $oauth2ClientFacade;

            return $this->createClient();
        });
    }

    /**
     * @return SecurityClientInterface
     */
    protected function createClient(): SecurityClientInterface
    {
        return new SecurityClient(
            $this->createAuthorizationManagerFactory()
        );
    }

    /**
     * @return AuthorizationManagerFactoryInterface
     */
    protected function createAuthorizationManagerFactory(): AuthorizationManagerFactoryInterface
    {
        return new AuthorizationManagerFactory(
            $this->oauth2ClientFacade,
            $this->securityFacade,
            $this->createSecurityTokenDataExpanderFactory(),
            $this->createTokenTransferExpanderFactory(),
        );
    }

    /**
     * @return TokenTransferExpanderFactoryInterface
     */
    protected function createTokenTransferExpanderFactory(): TokenTransferExpanderFactoryInterface
    {
        return new TokenTransferExpanderFactory(
            new TokenTransferExpanderDefault(),
            new TokenTransferExpanderOwner()
        );
    }

    /**
     * @return SecurityTokenDataExpanderFactoryInterface
     */
    protected function createSecurityTokenDataExpanderFactory(): SecurityTokenDataExpanderFactoryInterface
    {
        return new SecurityTokenDataExpanderFactory(
            new TokenDataExpanderDefault(),
            new TokenDataExpanderOwner(),
        );
    }
}

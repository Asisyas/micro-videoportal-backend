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

namespace App\Client\Security\Authorization;

use App\Client\Security\Authorization\Expander\SecurityTokenDataExpanderFactoryInterface;
use App\Client\Security\Authorization\Expander\TokenTransferExpanderFactoryInterface;
use Micro\Plugin\OAuth2\Client\Facade\Oauth2ClientFacadeInterface;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class AuthorizationManagerFactory implements AuthorizationManagerFactoryInterface
{
    /**
     * @param Oauth2ClientFacadeInterface $oauth2ClientFacade
     * @param SecurityFacadeInterface $securityFacade
     * @param SecurityTokenDataExpanderFactoryInterface $securityTokenDataExpanderFactory
     * @param TokenTransferExpanderFactoryInterface $tokenTransferExpanderFactory
     */
    public function __construct(
        private readonly Oauth2ClientFacadeInterface $oauth2ClientFacade,
        private readonly SecurityFacadeInterface $securityFacade,
        private readonly SecurityTokenDataExpanderFactoryInterface $securityTokenDataExpanderFactory,
        private readonly TokenTransferExpanderFactoryInterface $tokenTransferExpanderFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): AuthorizationManagerInterface
    {
        return new AuthorizationManager(
            $this->oauth2ClientFacade,
            $this->securityFacade,
            $this->securityTokenDataExpanderFactory->create(),
            $this->tokenTransferExpanderFactory->create(),
        );
    }
}

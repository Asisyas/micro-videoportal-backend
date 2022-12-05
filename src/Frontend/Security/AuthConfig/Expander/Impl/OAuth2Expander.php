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

namespace App\Frontend\Security\AuthConfig\Expander\Impl;

use App\Frontend\Security\AuthConfig\Expander\AuthConfigTransferExpanderInterface;
use App\Shared\Generated\DTO\Security\AuthConfigurationTransfer;
use Micro\Plugin\OAuth2\Client\Facade\Oauth2ClientFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class OAuth2Expander implements AuthConfigTransferExpanderInterface
{
    /**
     * @param Oauth2ClientFacadeInterface $oauth2ClientFacade
     */
    public function __construct(
        private readonly Oauth2ClientFacadeInterface $oauth2ClientFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(AuthConfigurationTransfer $authConfigurationTransfer): void
    {
        $provider = $this->oauth2ClientFacade->getProvider('default');

        $authConfigurationTransfer->setUrlAuth($provider->getAuthorizationUrl());
    }
}
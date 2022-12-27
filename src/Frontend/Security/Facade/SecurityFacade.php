<?php

declare(strict_types=1);

/**
 * This file is part of the Video portal application
 * based on the Micro Framework.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Frontend\Security\Facade;

use App\Frontend\Security\AuthConfig\AuthConfigurationFactoryInterface;
use App\Frontend\Security\Authenticator\AuthenticatorFactoryInterface;
use App\Frontend\Security\Token\Model\AuthTokenInterface;
use App\Shared\Generated\DTO\Security\AuthConfigurationTransfer;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class SecurityFacade implements SecurityFacadeInterface
{
    /**
     * @var AuthTokenInterface
     */
    private readonly AuthTokenInterface $authToken;

    /**
     * @param AuthenticatorFactoryInterface $authenticatorFactory
     * @param AuthConfigurationFactoryInterface $authConfigurationFactory
     */
    public function __construct(
        private readonly AuthenticatorFactoryInterface $authenticatorFactory,
        private readonly AuthConfigurationFactoryInterface $authConfigurationFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function authenticateRequest(Request $request): AuthTokenInterface
    {
        $this->authToken = $this->authenticatorFactory
            ->create()
            ->authenticateRequest($request);

        return $this->authToken;
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthToken(): AuthTokenInterface
    {
        return $this->authToken;
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthConfiguration(): AuthConfigurationTransfer
    {
        return $this
            ->authConfigurationFactory
            ->create();
    }
}

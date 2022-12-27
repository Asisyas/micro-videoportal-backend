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

namespace App\Client\Security\Client;

use App\Client\Security\Authorization\AuthorizationManagerFactoryInterface;
use App\Shared\Generated\DTO\Security\AuthCodeRequestTransfer;
use App\Shared\Generated\DTO\Security\TokenTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class SecurityClient implements SecurityClientInterface
{
    /**
     * @param AuthorizationManagerFactoryInterface $authorizationManagerFactory
     */
    public function __construct(
        private readonly AuthorizationManagerFactoryInterface $authorizationManagerFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function authorizeByCode(AuthCodeRequestTransfer $authCodeRequestTransfer): TokenTransfer
    {
        return $this->authorizationManagerFactory
            ->create()
            ->authorizeByCode($authCodeRequestTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function refreshToken(TokenTransfer $tokenTransfer): void
    {
        $this->authorizationManagerFactory
            ->create()
            ->refreshToken($tokenTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function decodeToken(TokenTransfer $tokenTransfer): void
    {
        $this->authorizationManagerFactory
            ->create()
            ->decodeToken($tokenTransfer);
    }
}

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

use App\Shared\Generated\DTO\Security\AuthCodeRequestTransfer;
use App\Shared\Generated\DTO\Security\TokenTransfer;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Micro\Plugin\Security\Exception\TokenExpiredException;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
interface AuthorizationManagerInterface
{
    /**
     * @param AuthCodeRequestTransfer $authCodeRequestTransfer
     *
     * @return TokenTransfer
     *
     * @throws IdentityProviderException
     */
    public function authorizeByCode(AuthCodeRequestTransfer $authCodeRequestTransfer): TokenTransfer;

    /**
     * @param TokenTransfer $tokenTransfer
     *
     * @return void
     *
     * @throws TokenExpiredException
     * @throws IdentityProviderException
     */
    public function refreshToken(TokenTransfer $tokenTransfer): void;

    /**
     * @param TokenTransfer $tokenTransfer
     *
     * @return void
     *
     * @throws TokenExpiredException
     * @throws IdentityProviderException
     */
    public function decodeToken(TokenTransfer $tokenTransfer): void;
}

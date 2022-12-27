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

namespace App\Client\Security\Authorization\Expander;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessTokenInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
interface SecurityTokenDataExpanderInterface
{
    /**
     * @param array $tokenData
     * @param AccessTokenInterface $accessToken
     * @param AbstractProvider $provider
     *
     * @return void
     */
    public function expand(array &$tokenData, AccessTokenInterface $accessToken, AbstractProvider $provider): void;
}

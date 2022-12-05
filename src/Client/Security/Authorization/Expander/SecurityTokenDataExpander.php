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
use League\OAuth2\Client\Token\AccessToken;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class SecurityTokenDataExpander implements SecurityTokenDataExpanderInterface
{
    /**
     * @param iterable<SecurityTokenDataExpanderInterface> $expanderCollection
     */
    public function __construct(
        private readonly iterable $expanderCollection
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(array &$tokenData, AccessToken $accessToken, AbstractProvider $provider): void
    {
        foreach ($this->expanderCollection as $expander) {
            $expander->expand($tokenData, $accessToken, $provider);
        }
    }
}
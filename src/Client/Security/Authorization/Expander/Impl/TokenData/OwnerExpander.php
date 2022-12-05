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

namespace App\Client\Security\Authorization\Expander\Impl\TokenData;

use App\Client\Security\Authorization\Expander\SecurityTokenDataExpanderInterface;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class OwnerExpander implements SecurityTokenDataExpanderInterface
{
    /**
     * {@inheritDoc}
     */
    public function expand(array &$tokenData, AccessToken $accessToken, AbstractProvider $provider): void
    {
        $owner = $provider->getResourceOwner($accessToken);
        $ownerData = $owner->toArray();
        $id = $owner->getId();
        $ownerData['id'] = $id;
        unset($ownerData['sub']);

        $tokenData['u'] = $ownerData;
    }
}
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

namespace App\Client\Security\Authorization\Expander\Impl\TokenTransfer;

use App\Client\Security\Authorization\Expander\TokenTransferExpanderInterface;
use App\Shared\Generated\DTO\Security\TokenTransfer;
use Micro\Plugin\Security\Token\TokenInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class DefaultExpander implements TokenTransferExpanderInterface
{
    /**
     * {@inheritDoc}
     */
    public function expand(TokenTransfer $tokenTransfer, TokenInterface $token): void
    {
        $tokenAccessExpiredAt = $token->getParameter('exp_ta', null);
        $tokenRefreshExpiredAt = $token->getParameter('exp', 0);
        $tokenTransfer
            ->setExpiresAtAccess((int) $tokenAccessExpiredAt)
            ->setExpiresAtRefresh((int) $tokenRefreshExpiredAt)
            ->setTimeNow($token->getParameter('tn', 0))
            ->setToken($token->getSource())
        ;
    }
}
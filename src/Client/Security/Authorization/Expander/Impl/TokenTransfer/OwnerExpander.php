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
use App\Shared\Generated\DTO\Security\TokenOwnerTransfer;
use App\Shared\Generated\DTO\Security\TokenTransfer;
use Micro\Plugin\Security\Token\TokenInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class OwnerExpander implements TokenTransferExpanderInterface
{
    /**
     * @param TokenTransfer $tokenTransfer
     * @param TokenInterface $token
     *
     * @return void
     */
    public function expand(TokenTransfer $tokenTransfer, TokenInterface $token): void
    {
        $userData = $token->getParameter('u', []);

        $tokenOwner = new TokenOwnerTransfer();
        $tokenOwner
            ->setEmail($userData['email'])
            ->setNameFirst($userData['given_name'])
            ->setNameLast($userData['family_name'])
            ->setId($userData['id']);

        $tokenTransfer->setUser($tokenOwner);
    }
}
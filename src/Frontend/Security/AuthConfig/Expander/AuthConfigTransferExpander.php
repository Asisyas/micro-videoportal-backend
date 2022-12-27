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

namespace App\Frontend\Security\AuthConfig\Expander;

use App\Shared\Generated\DTO\Security\AuthConfigurationTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class AuthConfigTransferExpander implements AuthConfigTransferExpanderInterface
{
    /**
     * @param iterable<AuthConfigTransferExpanderInterface> $expanderCollection
     */
    public function __construct(
        private readonly iterable $expanderCollection
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(AuthConfigurationTransfer $authConfigurationTransfer): void
    {
        foreach ($this->expanderCollection as $expander) {
            $expander->expand($authConfigurationTransfer);
        }
    }
}

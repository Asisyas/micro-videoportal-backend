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

namespace App\Frontend\Security\AuthConfig;

use App\Frontend\Security\AuthConfig\Expander\AuthConfigTransferExpanderFactoryInterface;
use App\Shared\Generated\DTO\Security\AuthConfigurationTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class AuthConfigurationFactory implements AuthConfigurationFactoryInterface
{
    /**
     * @param AuthConfigTransferExpanderFactoryInterface $authConfigTransferExpanderFactory
     */
    public function __construct(
        private readonly AuthConfigTransferExpanderFactoryInterface $authConfigTransferExpanderFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): AuthConfigurationTransfer
    {
        $authConfigurationTransfer = new AuthConfigurationTransfer();

        $this->authConfigTransferExpanderFactory
            ->create()
            ->expand($authConfigurationTransfer);

        return $authConfigurationTransfer;
    }
}

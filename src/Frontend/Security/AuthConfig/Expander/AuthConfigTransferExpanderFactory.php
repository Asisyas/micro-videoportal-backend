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

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class AuthConfigTransferExpanderFactory implements AuthConfigTransferExpanderFactoryInterface
{
    /**
     * @var iterable<AuthConfigTransferExpanderInterface>
     */
    private readonly iterable $expanderCollection;

    /**
     * @param AuthConfigTransferExpanderInterface ...$expanderCollection
     */
    public function __construct(
        AuthConfigTransferExpanderInterface ...$expanderCollection
    )
    {
        $this->expanderCollection = $expanderCollection;
    }

    /**
     * @return AuthConfigTransferExpanderInterface
     */
    public function create(): AuthConfigTransferExpanderInterface
    {
        return new AuthConfigTransferExpander($this->expanderCollection);
    }
}
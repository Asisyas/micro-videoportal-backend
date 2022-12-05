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

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class SecurityTokenDataExpanderFactory implements SecurityTokenDataExpanderFactoryInterface
{
    /**
     * @var iterable<SecurityTokenDataExpanderInterface>
     */
    private readonly iterable $expanderCollection;

    /**
     * @param SecurityTokenDataExpanderInterface ...$expanderCollection
     */
    public function __construct(SecurityTokenDataExpanderInterface ...$expanderCollection)
    {
        $this->expanderCollection = $expanderCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): SecurityTokenDataExpanderInterface
    {
        return new SecurityTokenDataExpander($this->expanderCollection);
    }
}
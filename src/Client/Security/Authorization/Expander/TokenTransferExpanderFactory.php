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
class TokenTransferExpanderFactory implements TokenTransferExpanderFactoryInterface
{
    /**
     * @var iterable<TokenTransferExpanderInterface>
     */
    private readonly iterable $expanderCollection;

    /**
     * @param TokenTransferExpanderInterface ...$expanderCollection
     */
    public function __construct(TokenTransferExpanderInterface ...$expanderCollection)
    {
        $this->expanderCollection = $expanderCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): TokenTransferExpanderInterface
    {
        return new TokenTransferExpander($this->expanderCollection);
    }
}
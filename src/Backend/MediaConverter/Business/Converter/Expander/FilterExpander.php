<?php

namespace App\Backend\MediaConverter\Business\Converter\Expander;

use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;

class FilterExpander implements FilterExpanderInterface
{
    /**
     * @param iterable<FilterExpanderInterface> $expanderCollection
     */
    public function __construct(
        private readonly iterable $expanderCollection
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(array &$filters, MediaResolutionTransfer $resolutionTransfer): void
    {
        foreach ($this->expanderCollection as $expander) {
            $expander->expand($filters, $resolutionTransfer);
        }
    }
}

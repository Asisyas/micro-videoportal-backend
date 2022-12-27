<?php

namespace App\Backend\MediaConverter\Business\Converter\Expander\Ext;

use App\Backend\MediaConverter\Business\Converter\Expander\FilterExpanderInterface;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;

class DefaultsExpander implements FilterExpanderInterface
{
    /**
     * {@inheritDoc}
     */
    public function expand(array &$filters, MediaResolutionTransfer $resolutionTransfer): void
    {
        $filters[] = '-dash';
        $filters[] = '1';
    }
}

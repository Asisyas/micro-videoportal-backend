<?php

namespace App\Backend\MediaConverter\Business\Converter\Expander;

use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;

interface FilterExpanderInterface
{
    /**
     * @param array $filters
     * @param MediaResolutionTransfer $resolutionTransfer
     */
    public function expand(array &$filters, MediaResolutionTransfer $resolutionTransfer): void;
}

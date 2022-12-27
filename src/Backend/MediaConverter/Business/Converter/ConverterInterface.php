<?php

namespace App\Backend\MediaConverter\Business\Converter;

use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;

interface ConverterInterface
{
    /**
     * @param MediaConfigurationTransfer $mediaConfigurationTransfer
     * @param callable|null $progressListener
     *
     * @return MediaConvertedResultTransfer
     */
    public function convert(MediaConfigurationTransfer $mediaConfigurationTransfer, callable $progressListener = null): MediaConvertedResultTransfer;
}

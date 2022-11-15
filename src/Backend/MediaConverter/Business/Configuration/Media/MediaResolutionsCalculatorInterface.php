<?php

namespace App\Backend\MediaConverter\Business\Configuration\Media;

use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionCollectionTransfer;

interface MediaResolutionsCalculatorInterface
{
    /**
     * @param MediaMetadataTransfer $metadataTransfer
     *
     * @return MediaResolutionCollectionTransfer
     */
    public function calculate(MediaMetadataTransfer $metadataTransfer): MediaResolutionCollectionTransfer;
}
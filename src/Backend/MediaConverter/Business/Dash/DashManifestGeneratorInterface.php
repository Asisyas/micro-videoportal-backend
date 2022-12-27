<?php

namespace App\Backend\MediaConverter\Business\Dash;

use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;

interface DashManifestGeneratorInterface
{
    /**
     * @param MediaConvertedResultCollectionTransfer $convertedResultCollectionTransfer
     *
     * @return DashManifestTransfer
     */
    public function generate(MediaConvertedResultCollectionTransfer $convertedResultCollectionTransfer): DashManifestTransfer;
}

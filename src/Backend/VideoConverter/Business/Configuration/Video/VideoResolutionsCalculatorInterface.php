<?php

namespace App\Backend\VideoConverter\Business\Configuration\Video;

use App\Shared\Generated\DTO\VideoConverter\ResolutionCollectionTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;

interface VideoResolutionsCalculatorInterface
{
    /**
     * @param VideoMetadataTransfer $metadataTransfer
     *
     * @return ResolutionCollectionTransfer
     */
    public function calculate(VideoMetadataTransfer $metadataTransfer): ResolutionCollectionTransfer;
}
<?php

namespace App\Backend\VideoConverter\Business\Configuration\Video;

use App\Shared\Generated\DTO\VideoConverter\VideoConvertCollectionTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;

interface ConverterConfigurationGeneratorInterface
{
    /**
     * @param VideoMetadataTransfer $metadataTransfer
     *
     * @return VideoConvertCollectionTransfer
     */
    public function generate(VideoMetadataTransfer $metadataTransfer): VideoConvertCollectionTransfer;
}
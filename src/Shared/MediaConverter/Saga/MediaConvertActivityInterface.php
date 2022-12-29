<?php

namespace App\Shared\MediaConverter\Saga;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionCollectionTransfer;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface(prefix: 'Media_converter.')]
interface MediaConvertActivityInterface extends ActivityInterface
{

}

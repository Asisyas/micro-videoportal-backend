<?php

namespace App\Backend\Saga\VideoPublish;

use App\Backend\MediaConverter\Facade\MediaConverterFacadeInterface;
use App\Client\File\FileClientInterface;
use App\Client\Video\Client\VideoClientInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionCollectionTransfer;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Saga\VideoPublish\VideoPublishActivityInterface;
use Micro\Library\DTO\Object\AbstractDto;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Logger\LoggerFacadeInterface;
use Temporal\Activity;

class VideoPublishActivity implements VideoPublishActivityInterface
{
    /**
     * @param FileClientInterface $fileClient
     */
    public function __construct(
        private readonly FileClientInterface           $fileClient
    )
    {
    }
    /**
     * {@inheritDoc}
     */
    public function lookupSourceFile(FileGetTransfer $fileGetTransfer): FileTransfer
    {
        return $this->fileClient->lookupFile($fileGetTransfer);
    }
}
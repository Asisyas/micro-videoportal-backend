<?php

namespace App\Backend\VideoPublish\Saga;

use App\Backend\VideoPublish\Facade\VideoPublishFacadeInterface;
use App\Client\File\FileClientInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Saga\VideoPublish\VideoPublishActivityInterface;

class VideoPublishActivity implements VideoPublishActivityInterface
{
    /**
     * @param FileClientInterface $fileClient
     * @param VideoPublishFacadeInterface $videoPublishFacade
     */
    public function __construct(
        private readonly FileClientInterface $fileClient,
        private readonly VideoPublishFacadeInterface $videoPublishFacade
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

    /**
     * {@inheritDoc}
     */
    public function propagateVideo(VideoGetTransfer $videoGetTransfer): bool
    {
        $this->videoPublishFacade->propagateVideo($videoGetTransfer);

        return true;
    }
}
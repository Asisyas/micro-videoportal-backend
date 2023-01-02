<?php

namespace App\Backend\Video\VideoPublish\Saga;

use App\Backend\Video\VideoPublish\Facade\VideoPublishFacadeInterface;
use App\Client\File\Client\ClientFileInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Video\VideoPublishActivityInterface;

class VideoPublishActivity implements VideoPublishActivityInterface
{
    /**
     * @param ClientFileInterface $fileClient
     * @param VideoPublishFacadeInterface $videoPublishFacade
     */
    public function __construct(
        private readonly ClientFileInterface         $fileClient,
        private readonly VideoPublishFacadeInterface $videoPublishFacade
    ) {
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

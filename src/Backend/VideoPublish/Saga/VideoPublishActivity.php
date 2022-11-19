<?php

namespace App\Backend\VideoPublish\Saga;

use App\Client\File\FileClientInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Saga\VideoPublish\VideoPublishActivityInterface;

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
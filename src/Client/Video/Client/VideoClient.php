<?php

namespace App\Client\Video\Client;

use App\Client\Video\Reader\VideoReaderFactoryInterface;
use App\Client\Video\Storage\VideoStorageFactoryInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\SourceSetTransfer;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

class VideoClient implements VideoClientInterface
{
    /**
     * @param VideoReaderFactoryInterface $videoReaderFactory
     * @param VideoStorageFactoryInterface $videoStorageFactory
     */
    public function __construct(
        private readonly VideoReaderFactoryInterface $videoReaderFactory,
        private readonly VideoStorageFactoryInterface $videoStorageFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer
    {
        return $this->videoStorageFactory
            ->create()
            ->createVideo($videoCreateTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function lookupVideo(VideoGetTransfer $videoGetTransfer): VideoTransfer
    {
        return $this->videoReaderFactory
            ->create()
            ->lookup($videoGetTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideo(VideoTransfer $videoTransfer): VideoTransfer
    {
        return $this->videoStorageFactory
            ->create()
            ->updateVideo($videoTransfer);
    }
}
<?php

namespace App\Client\Video\Client;

use App\Client\Video\Publisher\VideoPublisherFactoryInterface;
use App\Client\Video\Reader\VideoReaderFactoryInterface;
use App\Client\Video\Storage\VideoStorageFactoryInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTRansfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

class VideoClient implements VideoClientInterface
{
    /**
     * @param VideoReaderFactoryInterface $videoReaderFactory
     * @param VideoStorageFactoryInterface $videoStorageFactory
     * @param VideoPublisherFactoryInterface $videoPublisherFactory
     */
    public function __construct(
        private readonly VideoReaderFactoryInterface $videoReaderFactory,
        private readonly VideoStorageFactoryInterface $videoStorageFactory,
        private readonly VideoPublisherFactoryInterface $videoPublisherFactory
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
    public function videoPublish(VideoPublishTransfer $videoPublishTransfer): void
    {
        $this->videoPublisherFactory
            ->create()
            ->publish($videoPublishTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function lookupVideo(VideoWatchTRansfer $videoGetTransfer): VideoTransfer
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
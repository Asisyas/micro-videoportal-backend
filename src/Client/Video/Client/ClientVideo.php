<?php

namespace App\Client\Video\Client;

use App\Client\Video\Publisher\VideoPublisherFactoryInterface;
use App\Client\Video\Reader\VideoReaderFactoryInterface;
use App\Client\Video\Storage\VideoStorageFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

readonly class ClientVideo implements ClientVideoInterface
{
    /**
     * @param VideoReaderFactoryInterface $videoReaderFactory
     * @param VideoStorageFactoryInterface $videoStorageFactory
     * @param VideoPublisherFactoryInterface $videoPublisherFactory
     */
    public function __construct(
        private VideoReaderFactoryInterface    $videoReaderFactory,
        private VideoStorageFactoryInterface   $videoStorageFactory,
        private VideoPublisherFactoryInterface $videoPublisherFactory
    ) {
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

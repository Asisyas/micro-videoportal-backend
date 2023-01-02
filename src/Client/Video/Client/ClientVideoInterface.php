<?php

namespace App\Client\Video\Client;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

interface ClientVideoInterface
{
    /**
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return VideoTransfer
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer;

    /**
     * @param VideoPublishTransfer $videoPublishTransfer
     *
     * @return void
     */
    public function videoPublish(VideoPublishTransfer $videoPublishTransfer): void;

    /**
     * @param VideoWatchTransfer $videoGetTransfer
     *
     * @return VideoTransfer
     *
     * @throws NotFoundException
     */
    public function lookupVideo(VideoWatchTransfer $videoGetTransfer): VideoTransfer;

    /**
     * @param VideoTransfer $videoTransfer
     *
     * @return VideoTransfer
     */
    public function updateVideo(VideoTransfer $videoTransfer): VideoTransfer;
}

<?php

namespace App\Backend\Video\Facade;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Exception\VideoNotFoundException;

interface VideoFacadeInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return VideoTransfer
     *
     * @throws VideoNotFoundException
     */
    public function lookupVideo(VideoGetTransfer $videoGetTransfer): VideoTransfer;

    /**
     * @param VideoPublishTransfer $videoPublishTransfer
     *
     * @return VideoTransfer
     */
    public function createVideo(VideoPublishTransfer $videoPublishTransfer): VideoTransfer;

    /**
     * @param VideoSrcSetTransfer $videoSrcSetTransfer
     *
     * @return void
     *
     * @throws VideoNotFoundException
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer): void;
}

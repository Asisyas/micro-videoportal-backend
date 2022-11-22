<?php

namespace App\Backend\Video\Business\Manager;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Exception\VideoNotFoundException;

interface VideoManagerInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return VideoTransfer
     *
     * @throws VideoNotFoundException
     */
    public function lookup(VideoGetTransfer $videoGetTransfer): VideoTransfer;

    /**
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return VideoTransfer
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer;

    /**
     * @param VideoSrcSetTransfer $videoSrcSetTransfer
     *
     * @return void
     *
     * @throws VideoNotFoundException
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer): void;
}
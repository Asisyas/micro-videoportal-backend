<?php

namespace App\Shared\Video;

use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Exception\VideoNotFoundException;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface(prefix: 'video.')]
interface VideoActivityInterface extends ActivityInterface
{
    /**
     * @param VideoPublishTransfer $videoPublishTransfer
     *
     * @return VideoTransfer
     */
    public function createVideo(VideoPublishTransfer $videoPublishTransfer): VideoTransfer;

    /**
     * @param VideoTransfer $videoTransfer
     *
     * @return bool
     */
    public function compensate(VideoTransfer $videoTransfer): bool;

    /**
     * @param VideoSrcSetTransfer $videoSrcSetTransfer
     *
     * @return bool
     *
     * @throws VideoNotFoundException
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer): bool;
}

<?php

namespace App\Shared\Saga\VideoUpdate;

use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Exception\VideoNotFoundException;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

#[\Temporal\Activity\ActivityInterface(prefix: 'video_update.')]
interface VideoUpdateActivityInterface extends ActivityInterface
{
    /**
     * @param VideoTransfer $videoTransfer
     *
     * @return VideoTransfer
     *
     * @throws VideoNotFoundException
     */
    public function updateVideo(VideoTransfer $videoTransfer): VideoTransfer;
}
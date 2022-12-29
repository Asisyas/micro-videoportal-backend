<?php

namespace App\Shared\Video\Saga;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
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
}

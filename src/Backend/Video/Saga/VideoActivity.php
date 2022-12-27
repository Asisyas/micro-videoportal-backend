<?php

namespace App\Backend\Video\Saga;

use App\Backend\Video\Facade\VideoFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Saga\VideoActivityInterface;

class VideoActivity implements VideoActivityInterface
{
    /**
     * @param VideoFacadeInterface $videoFacade
     */
    public function __construct(
        private readonly VideoFacadeInterface $videoFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function createVideo(VideoPublishTransfer $videoPublishTransfer): VideoTransfer
    {
        return $this->videoFacade->createVideo($videoPublishTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer): bool
    {
        $this->videoFacade->updateVideoSrc($videoSrcSetTransfer);

        return true;
    }
}

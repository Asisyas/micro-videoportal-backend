<?php

namespace App\Backend\Video\Saga;

use App\Backend\Video\Facade\VideoFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
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
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer
    {
        return $this->videoFacade->createVideo($videoCreateTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer): void
    {
        $this->videoFacade->updateVideoSrc($videoSrcSetTransfer);
    }
}
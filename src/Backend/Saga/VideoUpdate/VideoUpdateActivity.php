<?php

namespace App\Backend\Saga\VideoUpdate;

use App\Backend\Video\Facade\VideoFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Saga\VideoUpdate\VideoUpdateActivityInterface;

class VideoUpdateActivity implements VideoUpdateActivityInterface
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
    public function updateVideo(VideoTransfer $videoTransfer): VideoTransfer
    {
        return $this->videoFacade->updateVideo($videoTransfer);
    }
}
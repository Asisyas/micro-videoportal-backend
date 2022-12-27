<?php

namespace App\Backend\Saga\VideoCreate;

use App\Backend\Video\Facade\VideoFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Saga\VideoCreate\VideoCreateActivityInterface;

class VideoCreateActivity implements VideoCreateActivityInterface
{
    /**
     * @param VideoFacadeInterface $videoFacade
     */
    public function __construct(private readonly VideoFacadeInterface $videoFacade)
    {
    }

    /**
     * @param VideoPublishTransfer $videoPublishTransfer
     *
     * @return VideoTransfer
     */
    public function createVideo(VideoPublishTransfer $videoPublishTransfer): VideoTransfer
    {
        return $this->videoFacade->createVideo($videoPublishTransfer);
    }
}

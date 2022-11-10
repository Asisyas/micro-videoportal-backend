<?php

namespace App\Backend\Video\Saga\VideoCreate;

use App\Backend\Video\Facade\VideoFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Saga\CreateVideo\VideoCreateActivityInterface;

class VideoCreateActivity implements VideoCreateActivityInterface
{
    /**
     * @param VideoFacadeInterface $videoFacade
     */
    public function __construct(private readonly VideoFacadeInterface $videoFacade)
    {
    }

    /**
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return VideoTransfer
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer
    {
        return $this->videoFacade->createVideo($videoCreateTransfer);
    }
}
<?php

namespace App\Backend\Video\Facade;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

interface VideoFacadeInterface
{
    /**
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return VideoTransfer
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer;
}
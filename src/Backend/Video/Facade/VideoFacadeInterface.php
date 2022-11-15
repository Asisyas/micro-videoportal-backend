<?php

namespace App\Backend\Video\Facade;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Exception\VideoNotFoundException;

interface VideoFacadeInterface
{
    /**
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return VideoTransfer
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer;

    /**
     * @param VideoTransfer $videoTransfer
     *
     * @return VideoTransfer
     *
     * @throws VideoNotFoundException
     */
    public function updateVideo(VideoTransfer $videoTransfer): VideoTransfer;
}
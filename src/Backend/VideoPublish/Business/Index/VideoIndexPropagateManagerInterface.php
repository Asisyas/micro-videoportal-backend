<?php

namespace App\Backend\VideoPublish\Business\Index;

use App\Shared\Generated\DTO\Video\VideoWatchTRansfer;

interface VideoIndexPropagateManagerInterface
{
    /**
     * @param VideoWatchTransfer $videoWatchTransfer
     *
     * @return void
     */
    public function propagateVideo(VideoWatchTransfer $videoWatchTransfer): void;
}
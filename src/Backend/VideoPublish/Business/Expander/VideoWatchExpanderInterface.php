<?php

namespace App\Backend\VideoPublish\Business\Expander;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;

interface VideoWatchExpanderInterface
{
    /**
     * @param VideoWatchTransfer $videoWatchTransfer
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return void
     */
    public function expand(VideoWatchTransfer $videoWatchTransfer, VideoGetTransfer $videoGetTransfer): void;
}
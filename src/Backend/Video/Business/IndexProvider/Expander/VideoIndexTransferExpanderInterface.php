<?php

namespace App\Backend\Video\Business\IndexProvider\Expander;

use App\Shared\Generated\DTO\Video\VideoIndexTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

interface VideoIndexTransferExpanderInterface
{
    /**
     * @param VideoIndexTransfer $videoIndexTransfer
     * @param VideoTransfer $videoTransfer
     *
     * @return void
     */
    public function expand(VideoIndexTransfer $videoIndexTransfer, VideoTransfer $videoTransfer): void;
}
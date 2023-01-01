<?php

namespace App\Backend\Video\VideoPublish\Business\Index;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;

interface VideoIndexPropagateManagerInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return void
     */
    public function propagateVideo(VideoGetTransfer $videoGetTransfer): void;
}

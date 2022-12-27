<?php

namespace App\Backend\VideoPublish\Business\Expander;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;

class VideoWatchExpander implements VideoWatchExpanderInterface
{
    /**
     * @param iterable $videoExpanderInterfaceCollection
     */
    public function __construct(
        private readonly iterable $videoExpanderInterfaceCollection,
    ) {
    }

    /**
     * @param VideoWatchTransfer $videoWatchTransfer
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return void
     */
    public function expand(VideoWatchTransfer $videoWatchTransfer, VideoGetTransfer $videoGetTransfer): void
    {
        foreach ($this->videoExpanderInterfaceCollection as $expander) {
            $expander->expand($videoWatchTransfer, $videoGetTransfer);
        }
    }
}

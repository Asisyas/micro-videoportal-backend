<?php

namespace App\Backend\Video\VideoPublish\Business\Expander\Impl;

use App\Backend\Video\Video\Facade\VideoFacadeInterface;
use App\Backend\Video\VideoPublish\Business\Expander\VideoWatchExpanderInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;

class VideoSourceExpander implements VideoWatchExpanderInterface
{
    /**
     * @param VideoFacadeInterface $videoFacade
     */
    public function __construct(private readonly VideoFacadeInterface $videoFacade)
    {
    }

    public function expand(VideoWatchTransfer $videoWatchTransfer, VideoGetTransfer $videoGetTransfer): void
    {
        $videoTransfer = $this->videoFacade->lookupVideo($videoGetTransfer);

        $videoWatchTransfer
            ->setChannelId($videoTransfer->getChannelId())
            ->setCreatedAt($videoTransfer->getCreatedAt())
            ->setSrc($videoTransfer->getSrc())
            ->setId($videoGetTransfer->getVideoId());
    }
}

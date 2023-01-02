<?php

namespace App\Backend\Video\VideoPublish\Business\Expander\Impl;

use App\Backend\Video\VideoDescription\Facade\VideoDescriptionFacadeInterface;
use App\Backend\Video\VideoPublish\Business\Expander\VideoWatchExpanderInterface;
use App\Shared\Generated\DTO\Video\VideoDescriptionGetTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;

class VideoDescriptionExpander implements VideoWatchExpanderInterface
{
    /**
     * @param VideoDescriptionFacadeInterface $videoDescriptionFacade
     */
    public function __construct(
        private readonly VideoDescriptionFacadeInterface $videoDescriptionFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(VideoWatchTransfer $videoWatchTransfer, VideoGetTransfer $videoGetTransfer): void
    {
        $videoDescription = $this->videoDescriptionFacade->lookup(
            (new VideoDescriptionGetTransfer())
                ->setVideoId($videoGetTransfer->getVideoId())
        );

        $videoWatchTransfer
            ->setTitle($videoDescription->getTitle())
            ->setDescription($videoDescription->getDescription());
    }
}

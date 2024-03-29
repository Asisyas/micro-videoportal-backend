<?php

namespace App\Backend\Video\Video\Facade;

use App\Backend\Video\Video\Business\Manager\VideoManagerFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

class VideoFacade implements VideoFacadeInterface
{
    /**
     * @param VideoManagerFactoryInterface $videoManagerFactory
     */
    public function __construct(
        private readonly VideoManagerFactoryInterface $videoManagerFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function lookupVideo(VideoGetTransfer $videoGetTransfer): VideoTransfer
    {
        return $this->videoManagerFactory
            ->create()
            ->lookup($videoGetTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function createVideo(VideoPublishTransfer $videoPublishTransfer): VideoTransfer
    {
        return $this->videoManagerFactory
            ->create()
            ->createVideo($videoPublishTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer): void
    {
        $this->videoManagerFactory
            ->create()
            ->updateVideoSrc($videoSrcSetTransfer);
    }
}

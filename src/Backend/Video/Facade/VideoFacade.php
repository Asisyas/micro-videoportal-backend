<?php

namespace App\Backend\Video\Facade;

use App\Backend\Video\Business\Manager\VideoManagerFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTRansfer;
use App\Shared\Generated\DTO\Video\VideoSrcSetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

class VideoFacade implements VideoFacadeInterface
{
    /**
     * @param VideoManagerFactoryInterface $videoManagerFactory
     */
    public function __construct(
        private readonly VideoManagerFactoryInterface $videoManagerFactory
    )
    {
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
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer
    {
        return $this->videoManagerFactory
            ->create()
            ->createVideo($videoCreateTransfer);
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
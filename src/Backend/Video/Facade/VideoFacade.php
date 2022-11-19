<?php

namespace App\Backend\Video\Facade;

use App\Backend\Video\Business\Manager\VideoManagerFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
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

    public function lookupVideo(VideoGetTransfer $videoGetTransfer): VideoTransfer
    {

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

    public function updateVideoSrc(VideoSrcSetTransfer $videoSrcSetTransfer): void
    {
        $this->videoManagerFactory
            ->create()
            ->updateVideoSrc($videoSrcSetTransfer);
    }
}
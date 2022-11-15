<?php

namespace App\Backend\Video\Facade;

use App\Backend\Video\Business\Factory\VideoFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

class VideoFacade implements VideoFacadeInterface
{
    /**
     * @param VideoFactoryInterface $videoFactory
     */
    public function __construct(
        private readonly VideoFactoryInterface $videoFactory
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer
    {
        return $this->videoFactory->create($videoCreateTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function updateVideo(VideoTransfer $videoTransfer): VideoTransfer
    {
        return $this->videoFactory->update($videoTransfer);
    }
}
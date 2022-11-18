<?php

namespace App\Backend\Video\Facade;

use App\Backend\Video\Business\Factory\VideoFactoryInterface;
use App\Backend\Video\Business\IndexProvider\IndexPopulateProviderFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

class VideoFacade implements VideoFacadeInterface
{
    /**
     * @param VideoFactoryInterface $videoFactory
     * @param IndexPopulateProviderFactoryInterface $indexPopulateProviderFactory
     */
    public function __construct(
        private readonly VideoFactoryInterface $videoFactory,
        private readonly IndexPopulateProviderFactoryInterface $indexPopulateProviderFactory
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

    /**
     * {@inheritDoc}
     */
    public function populateVideo(VideoTransfer $videoTransfer): void
    {
        $this->indexPopulateProviderFactory
            ->create()
            ->populate($videoTransfer);
    }
}
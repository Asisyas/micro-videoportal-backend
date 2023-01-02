<?php

namespace App\Backend\Video\VideoPublish\Facade;

use App\Backend\Video\VideoPublish\Business\Index\VideoIndexPropagateManagerFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;

class VideoPublishFacade implements VideoPublishFacadeInterface
{
    /**
     * @param VideoIndexPropagateManagerFactoryInterface $videoIndexPropagateManagerFactory
     */
    public function __construct(
        private readonly VideoIndexPropagateManagerFactoryInterface $videoIndexPropagateManagerFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function propagateVideo(VideoGetTransfer $videoGetTransfer): void
    {
        $this->videoIndexPropagateManagerFactory
            ->create()
            ->propagateVideo($videoGetTransfer);
    }
}

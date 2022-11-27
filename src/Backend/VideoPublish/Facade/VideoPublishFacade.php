<?php

namespace App\Backend\VideoPublish\Facade;

use App\Backend\VideoPublish\Business\Index\VideoIndexPropagateManagerFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;

class VideoPublishFacade implements VideoPublishFacadeInterface
{
    /**
     * @param VideoIndexPropagateManagerFactoryInterface $videoIndexPropagateManagerFactory
     */
    public function __construct(
        private readonly VideoIndexPropagateManagerFactoryInterface $videoIndexPropagateManagerFactory
    )
    {
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
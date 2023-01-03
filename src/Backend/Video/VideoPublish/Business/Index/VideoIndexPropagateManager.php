<?php

namespace App\Backend\Video\VideoPublish\Business\Index;

use App\Backend\Video\Video\Facade\VideoFacadeInterface;
use App\Backend\Video\VideoPublish\Business\Index\Propagator\IndexPropagatorInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;

class VideoIndexPropagateManager implements VideoIndexPropagateManagerInterface
{
    /**
     * @param VideoFacadeInterface $videoFacade
     * @param IndexPropagatorInterface $indexPropagator
     */
    public function __construct(
        private readonly VideoFacadeInterface $videoFacade,
        private readonly IndexPropagatorInterface $indexPropagator
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function propagateVideo(VideoGetTransfer $videoGetTransfer): void
    {
        $this->indexPropagator->propagate($this->videoFacade->lookupVideo($videoGetTransfer));
    }
}

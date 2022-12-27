<?php

namespace App\Backend\VideoPublish\Business\Index;

use App\Backend\VideoPublish\Business\Factory\VideoWatchTransferFactoryInterface;
use App\Backend\VideoPublish\Business\Index\Propagator\IndexPropagatorInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;

class VideoIndexPropagateManager implements VideoIndexPropagateManagerInterface
{
    /**
     * @param VideoWatchTransferFactoryInterface $videoWatchTransferFactory
     * @param IndexPropagatorInterface $indexPropagator
     */
    public function __construct(
        private readonly VideoWatchTransferFactoryInterface $videoWatchTransferFactory,
        private readonly IndexPropagatorInterface $indexPropagator
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function propagateVideo(VideoGetTransfer $videoGetTransfer): void
    {
        $videoWatchTransfer = $this->videoWatchTransferFactory->create($videoGetTransfer);

        $this->indexPropagator->propagate($videoWatchTransfer);
    }
}

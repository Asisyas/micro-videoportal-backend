<?php

namespace App\Backend\VideoPublish\Business\Index;

use App\Backend\VideoPublish\Business\Factory\VideoWatchTransferFactoryInterface;
use App\Backend\VideoPublish\Business\Index\Propagator\IndexPropagatorFactoryInterface;

class VideoIndexPropagateManagerFactory implements VideoIndexPropagateManagerFactoryInterface
{
    /**
     * @param IndexPropagatorFactoryInterface $indexPropagatorFactory
     * @param VideoWatchTransferFactoryInterface $videoWatchTransferFactory
     */
    public function __construct(
        private readonly IndexPropagatorFactoryInterface $indexPropagatorFactory,
        private readonly VideoWatchTransferFactoryInterface $videoWatchTransferFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoIndexPropagateManagerInterface
    {
        return new VideoIndexPropagateManager(
            $this->videoWatchTransferFactory,
            $this->indexPropagatorFactory->create(),
        );
    }
}

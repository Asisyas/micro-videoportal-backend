<?php

namespace App\Backend\Video\VideoPublish\Business\Index;

use App\Backend\Video\Video\Facade\VideoFacadeInterface;
use App\Backend\Video\VideoPublish\Business\Factory\VideoWatchTransferFactoryInterface;
use App\Backend\Video\VideoPublish\Business\Index\Propagator\IndexPropagatorFactoryInterface;

class VideoIndexPropagateManagerFactory implements VideoIndexPropagateManagerFactoryInterface
{
    /**
     * @param IndexPropagatorFactoryInterface $indexPropagatorFactory
     * @param VideoFacadeInterface $videoFacade
     */
    public function __construct(
        private readonly IndexPropagatorFactoryInterface $indexPropagatorFactory,
        private readonly VideoFacadeInterface $videoFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoIndexPropagateManagerInterface
    {
        return new VideoIndexPropagateManager(
            $this->videoFacade,
            $this->indexPropagatorFactory->create(),
        );
    }
}

<?php

namespace App\Client\Video\Publisher;

use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;

class VideoPublisherFactory implements VideoPublisherFactoryInterface
{
    /**
     * @param TemporalFacadeInterface $temporalFacade
     */
    public function __construct(
        private readonly TemporalFacadeInterface $temporalFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoPublisherInterface
    {
       return new VideoPublisher($this->temporalFacade->workflowClient());
    }
}
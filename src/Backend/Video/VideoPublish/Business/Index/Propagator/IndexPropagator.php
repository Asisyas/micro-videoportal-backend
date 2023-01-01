<?php

namespace App\Backend\Video\VideoPublish\Business\Index\Propagator;

use App\Shared\Generated\DTO\Video\VideoWatchTransfer;

class IndexPropagator implements IndexPropagatorInterface
{
    /**
     * @param iterable<IndexPropagatorInterface> $indexPropagatorCollection
     */
    public function __construct(private readonly iterable $indexPropagatorCollection)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function propagate(VideoWatchTransfer $videoWatchTransfer): void
    {
        foreach ($this->indexPropagatorCollection as $propagator) {
            $propagator->propagate($videoWatchTransfer);
        }
    }
}

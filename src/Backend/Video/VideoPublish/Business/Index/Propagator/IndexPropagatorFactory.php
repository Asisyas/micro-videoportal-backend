<?php

namespace App\Backend\Video\VideoPublish\Business\Index\Propagator;

class IndexPropagatorFactory implements IndexPropagatorFactoryInterface
{
    /**
     * @var iterable<IndexPropagatorInterface>
     */
    private readonly iterable $indexPropagator;

    /**
     * @param IndexPropagatorInterface ...$indexPropagator
     */
    public function __construct(IndexPropagatorInterface ...$indexPropagator)
    {
        $this->indexPropagator = $indexPropagator;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): IndexPropagatorInterface
    {
        return new IndexPropagator($this->indexPropagator);
    }
}

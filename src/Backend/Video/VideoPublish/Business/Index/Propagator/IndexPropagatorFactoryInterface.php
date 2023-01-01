<?php

namespace App\Backend\Video\VideoPublish\Business\Index\Propagator;

interface IndexPropagatorFactoryInterface
{
    /**
     * @return IndexPropagatorInterface
     */
    public function create(): IndexPropagatorInterface;
}

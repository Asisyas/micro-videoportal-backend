<?php

namespace App\Backend\VideoPublish\Business\Index\Propagator;

interface IndexPropagatorFactoryInterface
{
    /**
     * @return IndexPropagatorInterface
     */
    public function create(): IndexPropagatorInterface;
}
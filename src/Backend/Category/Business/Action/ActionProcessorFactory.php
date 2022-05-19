<?php

namespace App\Backend\Category\Business\Action;

class ActionProcessorFactory implements ActionProcessorFactoryInterface
{
    /**
     * @var iterable<ActionFactoryInterface>
     */
    private readonly iterable $actionFactoryCollection;

    /**
     * @param ActionFactoryInterface ...$actionFactoryCollection
     */
    public function __construct(ActionFactoryInterface ...$actionFactoryCollection)
    {
        $this->actionFactoryCollection = $actionFactoryCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ActionProcessorInterface
    {
        return new ActionProcessor($this->actionFactoryCollection);
    }
}
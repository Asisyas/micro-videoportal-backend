<?php

namespace App\Backend\Category\Business\Action;

interface ActionProcessorFactoryInterface
{
    /**
     * @return ActionProcessorInterface
     */
    public function create(): ActionProcessorInterface;
}
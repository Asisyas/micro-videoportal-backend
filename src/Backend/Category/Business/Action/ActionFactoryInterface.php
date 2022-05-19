<?php

namespace App\Backend\Category\Business\Action;

interface ActionFactoryInterface
{
    /**
     * @return ActionInterface
     */
    public function create(): ActionInterface;
}
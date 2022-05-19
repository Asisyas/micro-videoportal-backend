<?php

namespace App\Backend\Category\Business\Action;

use App\Shared\Generated\DTO\Category\CategoryTransfer;

class ActionProcessor implements ActionProcessorInterface
{
    /**
     * @param iterable<ActionFactoryInterface> $actionFactoryCollection
     */
    public function __construct(private readonly iterable $actionFactoryCollection)
    {
    }

    /**
     * @param CategoryTransfer $categoryTransfer
     *
     * @return void
     */
    public function process(CategoryTransfer $categoryTransfer): void
    {
        foreach ($this->actionFactoryCollection as $actionFactory) {
            $actionFactory->create()->process($categoryTransfer);
        }
    }
}
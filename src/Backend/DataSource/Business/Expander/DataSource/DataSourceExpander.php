<?php

namespace App\Backend\DataSource\Business\Expander\DataSource;

use App\Backend\DataSource\Business\Expander\DataSource\Processor\ExpanderProcessorInterface;
use App\Backend\DataSource\Entity\DataSource;
use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

class DataSourceExpander implements DataSourceExpanderInterface
{
    /**
     * @param DataSource $dataSource
     * @param iterable<ExpanderProcessorInterface> $expanderProcessorCollection
     */
    public function __construct(
        private readonly DataSource $dataSource,
        private readonly iterable $expanderProcessorCollection
    )
    {}

    /**
     * {@inheritDoc}
     */
    public function expand(DataSourceTransfer $dataSourceTransfer): void
    {
        foreach ($this->expanderProcessorCollection as $processor) {
            $processor->process($this->dataSource, $dataSourceTransfer);
        }
    }
}
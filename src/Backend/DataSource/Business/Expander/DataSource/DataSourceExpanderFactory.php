<?php

namespace App\Backend\DataSource\Business\Expander\DataSource;

use App\Backend\DataSource\Business\Expander\DataSource\Processor\ExpanderProcessorInterface;
use App\Backend\DataSource\Entity\DataSource;

class DataSourceExpanderFactory implements DataSourceExpanderFactoryInterface
{
    /**
     * @param iterable<ExpanderProcessorInterface> $expanderProcessorCollection
     */
    public function __construct(private iterable $expanderProcessorCollection)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(DataSource $dataSource): DataSourceExpanderInterface
    {
        return new DataSourceExpander(
            $dataSource,
            $this->expanderProcessorCollection
        );
    }
}
<?php

namespace App\Backend\DataSource\Business\Expander\DataSource\Processor;

use App\Backend\DataSource\Entity\DataSource;
use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

class EntityBasicFieldsProcessor implements ExpanderProcessorInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(DataSource $dataSource, DataSourceTransfer $dataSourceTransfer): void
    {
        $dataSourceTransfer->setType($dataSource->getType());
        $dataSourceTransfer->setUuid($dataSource->getUuid());
        $dataSourceTransfer->setName($dataSource->getName());
    }
}
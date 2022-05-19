<?php

namespace App\Backend\DataSource\Business\Expander\DataSource\Processor;

use App\Backend\DataSource\Entity\DataSource;
use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

interface ExpanderProcessorInterface
{
    /**
     * @param DataSource $dataSource
     * @param DataSourceTransfer $dataSourceTransfer
     *
     * @return void
     */
    public function process(DataSource $dataSource, DataSourceTransfer $dataSourceTransfer): void;
}
<?php

namespace App\Backend\DataSource\Business\Expander\DataSource;

use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

interface DataSourceExpanderInterface
{
    /**
     * @param DataSourceTransfer $dataSourceTransfer
     */
    public function expand(DataSourceTransfer $dataSourceTransfer): void;
}
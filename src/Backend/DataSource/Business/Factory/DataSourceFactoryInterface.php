<?php

namespace App\Backend\DataSource\Business\Factory;

use App\Shared\Generated\DTO\DataSource\DataSourceCreateTransfer;
use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

interface DataSourceFactoryInterface
{
    /**
     * @param DataSourceCreateTransfer $dataSourceCreateTransfer
     *
     * @return DataSourceTransfer
     */
    public function create(DataSourceCreateTransfer $dataSourceCreateTransfer): DataSourceTransfer;
}
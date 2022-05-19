<?php

namespace App\Shared\DataSource\Facade;

use App\Shared\Generated\DTO\DataSource\DataSourceCreateTransfer;
use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

interface DataSourceFacadeInterface
{
    /**
     * @param DataSourceCreateTransfer $dataSourceCreateTransfer
     *
     * @return DataSourceTransfer
     */
    public function createDataSource(DataSourceCreateTransfer $dataSourceCreateTransfer): DataSourceTransfer;
}
<?php

namespace App\Backend\DataSource\Business\Transformer\DataSource;

use App\Backend\DataSource\Entity\DataSource;
use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

interface DataSourceTransformerInterface
{
    /**
     * @param DataSource $dataSource
     *
     * @return DataSourceTransfer
     */
    public function transform(DataSource $dataSource): DataSourceTransfer;
}
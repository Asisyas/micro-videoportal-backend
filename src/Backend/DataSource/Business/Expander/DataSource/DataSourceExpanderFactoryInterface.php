<?php

namespace App\Backend\DataSource\Business\Expander\DataSource;

use App\Backend\DataSource\Entity\DataSource;

interface DataSourceExpanderFactoryInterface
{
    /**
     * @param DataSource $dataSource
     *
     * @return DataSourceExpanderInterface
     */
    public function create(DataSource $dataSource): DataSourceExpanderInterface;
}
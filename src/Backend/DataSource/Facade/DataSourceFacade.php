<?php

namespace App\Backend\DataSource\Facade;

use App\Backend\DataSource\Business\Factory\DataSourceFactoryInterface;
use App\Shared\DataSource\Facade\DataSourceFacadeInterface;
use App\Shared\Generated\DTO\DataSource\DataSourceCreateTransfer;
use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

class DataSourceFacade implements DataSourceFacadeInterface
{
    /**
     * @param DataSourceFactoryInterface $dataSourceFactory
     */
    public function __construct(private readonly DataSourceFactoryInterface $dataSourceFactory)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createDataSource(DataSourceCreateTransfer $dataSourceCreateTransfer): DataSourceTransfer
    {
        return $this->dataSourceFactory->create($dataSourceCreateTransfer);
    }
}
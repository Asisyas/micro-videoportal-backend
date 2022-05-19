<?php

namespace App\Backend\DataSource\Business\Transformer\DataSource;

use App\Backend\DataSource\Business\Expander\DataSource\DataSourceExpanderFactoryInterface;
use App\Backend\DataSource\Entity\DataSource;
use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

class DataSourceFromEntityTransformer implements DataSourceTransformerInterface
{
    /**
     * @param DataSourceExpanderFactoryInterface $dataSourceExpanderFactory
     */
    public function __construct(private readonly DataSourceExpanderFactoryInterface $dataSourceExpanderFactory)
    {
    }

    /**
     * @param DataSource $dataSource
     * @return DataSourceTransfer
     */
    public function transform(DataSource $dataSource): DataSourceTransfer
    {
        $dataSourceTransfer = $this->createDataSourceTransfer();

        $this->dataSourceExpanderFactory
            ->create($dataSource)
            ->expand($dataSourceTransfer);

        return $dataSourceTransfer;
    }

    /**
     * @return DataSourceTransfer
     */
    protected function createDataSourceTransfer(): DataSourceTransfer
    {
        return new DataSourceTransfer();
    }
}
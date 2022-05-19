<?php

namespace App\Backend\DataSource\Business\Factory;

use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;
use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Backend\DataSource\Business\Transformer\DataSource\DataSourceTransformerInterface;
use App\Backend\DataSource\Entity\DataSource;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use App\Shared\Generated\DTO\DataSource\DataSourceCreateTransfer;
use App\Shared\Generated\DTO\DataSource\DataSourceTransfer;

class DataSourceFactory implements DataSourceFactoryInterface
{
    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param DataSourceTransformerInterface $dataSourceTransformer
     * @param ClientStorageFacadeInterface $clientStorageFacade
     */
    public function __construct(
        private readonly UuidFacadeInterface $uuidFacade,
        private readonly DoctrineFacadeInterface $doctrineFacade,
        private readonly DataSourceTransformerInterface $dataSourceTransformer,
        private readonly ClientStorageFacadeInterface $clientStorageFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(DataSourceCreateTransfer $dataSourceCreateTransfer): DataSourceTransfer
    {
        $dataSource = new DataSource($this->uuidFacade->v4());

        $dataSource->setName($dataSourceCreateTransfer->getName());
        $dataSource->setType($dataSourceCreateTransfer->getType());

        $this->saveDataSource($dataSource);

        $dataSourceTransfer = $this->dataSourceTransformer->transform($dataSource);

        $this->syncWithClient($dataSourceTransfer);

        return $dataSourceTransfer;
    }

    /**
     * @param DataSource $dataSource
     *
     * @return void
     */
    protected function saveDataSource(DataSource $dataSource): void
    {
        $manager = $this->doctrineFacade->getManager();
        $manager->persist($dataSource);
        $manager->flush();
    }

    /**
     * @param DataSourceTransfer $dataSourceTransfer
     *
     * @return void
     */
    protected function syncWithClient(DataSourceTransfer $dataSourceTransfer): void
    {
        $putTransfer = new PutTransfer();

        $putTransfer->setIndex('data_source');
        $putTransfer->setUuid($dataSourceTransfer->getUuid());
        $putTransfer->setData($dataSourceTransfer->toArray());


        $this->clientStorageFacade->put($putTransfer);
    }
}
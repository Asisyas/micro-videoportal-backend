<?php

namespace App\Backend\Video\Business\IndexProvider;

use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Backend\Video\Business\IndexProvider\Expander\VideoIndexTransferExpanderFactoryInterface;

class IndexPopulateProviderFactory implements IndexPopulateProviderFactoryInterface
{
    /**
     * @param SearchStorageFacadeInterface $searchStorageFacade
     * @param VideoIndexTransferExpanderFactoryInterface $indexTransferExpanderFactory
     */
    public function __construct(
        private readonly SearchStorageFacadeInterface $searchStorageFacade,
        private readonly VideoIndexTransferExpanderFactoryInterface $indexTransferExpanderFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): IndexPopulateProviderInterface
    {
        return new IndexPopulateProvider(
            $this->searchStorageFacade,
            $this->indexTransferExpanderFactory->create()
        );
    }
}
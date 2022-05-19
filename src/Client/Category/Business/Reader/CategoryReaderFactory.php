<?php

namespace App\Client\Category\Business\Reader;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;

class CategoryReaderFactory implements CategoryReaderFactoryInterface
{
    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     */
    public function __construct(private readonly ClientReaderFacadeInterface $clientReaderFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): CategoryReaderInterface
    {
        return new CategoryReader($this->clientReaderFacade);
    }
}
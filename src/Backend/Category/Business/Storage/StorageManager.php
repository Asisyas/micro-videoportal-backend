<?php

namespace App\Backend\Category\Business\Storage;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Shared\Category\Configuration;
use App\Shared\Generated\DTO\Category\CategoryTransfer;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;

class StorageManager implements StorageManagerInterface
{
    /**
     * @param ClientStorageFacadeInterface $clientStorageFacade
     */
    public function __construct(private readonly ClientStorageFacadeInterface $clientStorageFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function put(CategoryTransfer $categoryTransfer): void
    {
        $put = new PutTransfer();

        $put->setIndex(Configuration::CLIENT_READER_INDEX);
        $put->setUuid($categoryTransfer->getUuid());
        $put->setData($categoryTransfer);

        $this->clientStorageFacade->put($put);
    }
}
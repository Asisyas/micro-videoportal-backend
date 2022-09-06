<?php

namespace App\Backend\File\Business\File\Storage;

use App\Backend\ClientStorage\Facade\ClientStorageFacadeInterface;
use App\Shared\File\Configuration;
use App\Shared\Generated\DTO\ClientStorage\DeleteTransfer;
use App\Shared\Generated\DTO\ClientStorage\PutTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;

class FileStorage implements FileStorageInterface
{
    /**
     * @param ClientStorageFacadeInterface $clientStorageFacade
     */
    public function __construct(
        private readonly ClientStorageFacadeInterface     $clientStorageFacade,
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function put(FileTransfer $fileTransfer): void
    {
        $putTransfer = new PutTransfer();
        $putTransfer->setData($fileTransfer);
        $putTransfer->setUuid($fileTransfer->getId());
        $putTransfer->setIndex(Configuration::CLIENT_STORAGE_FILE_IDX);

        $this->clientStorageFacade->put($putTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function remove(FileRemoveTransfer $fileRemoveTransfer): void
    {
        $deleteTransfer = new DeleteTransfer();
        $deleteTransfer->setIndex(Configuration::CLIENT_STORAGE_FILE_IDX);
        $deleteTransfer->setUuid($fileRemoveTransfer->getId());

        $this->clientStorageFacade->delete($deleteTransfer);
    }
}
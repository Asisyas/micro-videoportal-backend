<?php

namespace App\Client\File\Reader;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\File\Expander\File\FileTransferExpanderInterface;
use App\Shared\File\Configuration;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use Micro\Library\DTO\SerializerFacadeInterface;

class FileClientReader implements FileClientReaderInterface
{
    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     * @param FileTransferExpanderInterface $fileTransferExpander
     */
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade,
        private readonly FileTransferExpanderInterface $fileTransferExpander
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function lookup(FileGetTransfer $fileGetTransfer): FileTransfer
    {
        $request = new RequestTransfer();
        $request->setUuid($fileGetTransfer->getId());
        $request->setIndex(Configuration::CLIENT_STORAGE_FILE_IDX);

        $response = $this->clientReaderFacade->lookup($request);
        /** @var FileTransfer $fileTransfer */
        $fileTransfer = $response->getData();
        $this->fileTransferExpander->expand($fileTransfer);

        return $fileTransfer;
    }
}

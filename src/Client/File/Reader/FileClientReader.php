<?php

namespace App\Client\File\Reader;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Shared\File\Configuration;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use Micro\Library\DTO\SerializerFacadeInterface;

class FileClientReader implements FileClientReaderInterface
{
    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     * @param SerializerFacadeInterface $serializerFacade
     */
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade,
        private readonly SerializerFacadeInterface $serializerFacade
    )
    {
    }

    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return FileTransfer
     */
    public function lookup(FileGetTransfer $fileGetTransfer): FileTransfer
    {
        $request = new RequestTransfer();
        $request->setUuid($fileGetTransfer->getId());
        $request->setIndex(Configuration::CLIENT_STORAGE_FILE_IDX);

        $response = $this->clientReaderFacade->lookup($request);
        /** @var FileTransfer $fileTransfer */
        $fileTransfer = $this->serializerFacade->fromArrayTransfer($response->getData());

        return $fileTransfer;
    }
}
<?php

namespace App\Client\File\Reader;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\File\Expander\File\FileTransferExpanderFactoryInterface;
use Micro\Library\DTO\SerializerFacadeInterface;

class FileClientReaderFactory implements FileClientReaderFactoryInterface
{
    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     * @param FileTransferExpanderFactoryInterface $fileTransferExpanderFactory
     */
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade,
        private readonly FileTransferExpanderFactoryInterface $fileTransferExpanderFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): FileClientReaderInterface
    {
        return new FileClientReader(
            $this->clientReaderFacade,
            $this->fileTransferExpanderFactory->create()
        );
    }
}
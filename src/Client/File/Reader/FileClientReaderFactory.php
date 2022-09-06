<?php

namespace App\Client\File\Reader;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use Micro\Library\DTO\SerializerFacadeInterface;

class FileClientReaderFactory implements FileClientReaderFactoryInterface
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
     * {@inheritDoc}
     */
    public function create(): FileClientReaderInterface
    {
        return new FileClientReader(
            $this->clientReaderFacade,
            $this->serializerFacade
        );
    }
}
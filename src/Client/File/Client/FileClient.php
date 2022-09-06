<?php

namespace App\Client\File\Client;

use App\Client\Amqp\Client\AmqpClientInterface;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Client\File\FileClientInterface;
use App\Shared\File\Configuration;
use App\Shared\Generated\DTO\Amqp\RpcRequestTransfer;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer as ClientReaderRequestTransfer;
use App\Shared\Generated\DTO\File\ChunkRequestTransfer;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\StreamCreateTransfer;
use App\Shared\Generated\DTO\File\StreamGetTransfer;
use App\Shared\Generated\DTO\File\StreamTransfer;
use Micro\Library\DTO\SerializerFacadeInterface;

class FileClient implements FileClientInterface
{
    /**
     * @param AmqpClientInterface $amqpClient
     * @param ClientReaderFacadeInterface $clientReaderFacade
     * @param SerializerFacadeInterface $serializerFacade
     */
    public function __construct(
        private readonly AmqpClientInterface $amqpClient,
        private readonly ClientReaderFacadeInterface $clientReaderFacade,
        private readonly SerializerFacadeInterface $serializerFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createFile(FileCreateTransfer $fileCreateTransfer): FileTransfer
    {
        $request = new RpcRequestTransfer();

        $request->setMessage($fileCreateTransfer);
        $request->setPublisher(Configuration::PUBLISHER_FILE_CREATE_NAME);

        return $this->amqpClient->rpc($request);
    }

    /**
     * {@inheritDoc}
     */
    public function getStream(StreamGetTransfer $streamGetTransfer): StreamTransfer
    {
        $clientRequest = new ClientReaderRequestTransfer();

        $clientRequest->setUuid($streamGetTransfer->getStreamId());
        $clientRequest->setIndex(Configuration::CLIENT_STORAGE_STREAM_IDX);

        $clientResponse = $this->clientReaderFacade->lookup($clientRequest);
        /** @var StreamTransfer $streamTransfer */
        $streamTransfer = $this->serializerFacade->fromArrayTransfer($clientResponse->getData());

        return $streamTransfer;
    }

    public function uploadCHunk(ChunkRequestTransfer $chunkRequest): ChunkResponseTransfer
    {

    }
}
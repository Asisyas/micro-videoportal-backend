<?php

namespace App\Frontend\File\Controller;

use App\Client\File\FileClientInterface;
use App\Shared\Generated\DTO\Amqp\ResponseTransfer;
use App\Shared\Generated\DTO\File\ChunkRequestTransfer;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\CredentialsRequestTransfer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FileUploadController
{
    /**
     * @param FileClientInterface $fileClient
     */
    public function __construct(private FileClientInterface $fileClient)
    {
    }

    /**
     * @param Request $request
     *
     * @return ResponseTransfer
     */
    public function createChannel(Request $request): ResponseTransfer
    {
        $reqContent = json_decode($request->getContent());

        $fileCredentials = new CredentialsRequestTransfer()
        ;
        $fileCredentials->setName($reqContent?->name);
        $fileCredentials->setSize($reqContent?->size);
        $fileCredentials->setType($reqContent?->type);

        $fileCredentials->setCrc32('UNKNOWN');

        return $this->fileClient->createChannel($fileCredentials);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function fileUpload(Request $request): ChunkResponseTransfer
    {
        $requestContent = json_decode($request->getContent());

        $chunkRequest = new ChunkRequestTransfer();
        $chunkRequest->setChannel($requestContent?->channel);
        $chunkRequest->setChannel($requestContent?->chunk);
        $chunkRequest->setBlob($requestContent?->blob);

        $chunkResponse = new ChunkResponseTransfer();

        $chunkResponse->setSizeLoaded(10000);
        $chunkResponse->setSizeRemaining(54534566346);

        return $chunkResponse;
    }
}
<?php

namespace App\Frontend\File\Controller;

use App\Client\File\FileClientInterface;
use App\Frontend\File\Facade\FileFacadeInterface;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\ChunkTransfer;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use Micro\Plugin\Http\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FileUploadController
{
    /**
     * @param FileFacadeInterface $fileFacade
     * @param FileClientInterface $fileClient
     */
    public function __construct(
        private readonly FileFacadeInterface $fileFacade,
        private readonly FileClientInterface $fileClient
    )
    {
    }

    /**
     * @param Request $request
     *
     * @return FileTransfer|JsonResponse
     *
     * @throws BadRequestException
     */
    public function createFile(Request $request): FileTransfer|JsonResponse
    {
        $reqContent = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $violations = $this->fileFacade->validateCreateStreamRequest($reqContent);
        if($violations !== null) {
            return new JsonResponse([
                'errors'    => $violations
            ], 400);
        }

        $fileCreateTransfer = new FileCreateTransfer();

        $fileCreateTransfer->setContentType($reqContent['content_type']);
        $fileCreateTransfer->setName($reqContent['name']);
        $fileCreateTransfer->setSize((int)$reqContent['size']);

        return $this->fileClient->createFile($fileCreateTransfer);
    }

    /**
     * @param Request $request
     *
     * @return Response|ChunkResponseTransfer
     *
     * @throws BadRequestException
     */
    public function uploadFile(Request $request): Response|ChunkResponseTransfer
    {
        $content = $request->getContent();
        $contentSize = $request->headers->get('Content-Length', 0);
        $contentRange = $request->headers->get('Content-Range');
        $fileId = $request->headers->get('File-Id');

        preg_match('/bytes=(\d+)-(\d+)\/(\d+)?/', $contentRange, $matches);
        if(count($matches) < 4) {
            throw new BadRequestException('Invalid "Content-Range" header.');
        }

        $chunkOffset = intval($matches[1]);
        $chunkSize = intval($matches[2]) - $chunkOffset;

        $chunkTransfer = new ChunkTransfer();
        $chunkTransfer->setBlob($content);
        $chunkTransfer->setOffset($chunkOffset);
        $chunkTransfer->setSize($chunkSize);
        $chunkTransfer->setFileId($fileId);

        $chunkResponseTransfer = $this->fileClient->uploadFile($chunkTransfer);
        if($chunkResponseTransfer->getSizeRemaining() === 0) {
            return new Response(null, 201);
        }

        return new Response(null, 206, [
            'Content-Range' => sprintf('bytes=%d-%d',
                $chunkResponseTransfer->getSizeLoaded(),
                $chunkResponseTransfer->getSizeRemaining()
            )
        ]);
    }


    /*
     *  $requestContent = json_decode($request->getContent());

        $findChannelRequest = new StreamGetTransfer();
        $findChannelRequest->setStreamId($requestContent?->id);

      //  $channel = $this->fileClient->getStream($findChannelRequest);

        $contentSize = $request->headers->get('Content-Length', 0);
        $contentRange = $request->headers->get('Content-Range');
        $fileId = $request->headers->get('File-Id');
        if(!$contentRange || !$contentSize) {
            throw new BadRequestException();
        }

        preg_match('/bytes=(\d+)-(\d+)\/(\d+)?/', $contentRange, $matches);
        if(count($matches) < 4) {
            throw new BadRequestException('Invalid "Content-Range" header.');
        }


        $chunkOffset = intval($matches[1]);
        $chunkLength = intval($matches[2]) - $chunkOffset;
        $docSize = intval($matches[3]);

        $chunkRequest = new ChunkRequestTransfer();
        $chunkRequest->setBlob($requestContent->blob);
        $chunkRequest->setChannel($requestContent->id);
        $chunkRequest->setOffset($chunkOffset);
        $chunkRequest->setSize($chunkLength);


        $filePath = '/var/cache/video/' . $chunkRequest->getChannel();
        if(!file_exists($filePath)) {
            mkdir($filePath);
        }
        $fileName = $filePath . '/video.mp4';
        if(!file_exists($fileName)) {
            file_put_contents($fileName, '');
        }

        $b64 = explode( ',', $chunkRequest->getBlob());
        $b64 = strtr($b64[1], '-_', '+/');

        $b64 = base64_decode($b64, true);
        if($b64 === false) {
            dump('CAN NOT DECODED FILE');

            exit;
        }

        $stream = fopen($fileName, 'ab');
        fseek($stream, $chunkRequest->getOffset());
        fwrite($stream, $b64);
        fclose($stream);

        $chunkResponse = new ChunkResponseTransfer();

        $fileSizeCurrent = filesize($fileName);
        $chunkResponse->setSizeLoaded($fileSizeCurrent);
        $chunkResponse->setSizeRemaining($channel->getSize() - $fileSizeCurrent);

        return $chunkResponse;
     */
}
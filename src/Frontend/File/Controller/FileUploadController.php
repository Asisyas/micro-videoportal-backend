<?php

namespace App\Frontend\File\Controller;

use App\Client\File\FileClientInterface;
use App\Frontend\File\Facade\FileFacadeInterface;
use App\Shared\Generated\DTO\File\ChunkRequestTransfer;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\StreamGetTransfer;
use App\Shared\Generated\DTO\File\StreamTransfer;
use Micro\Plugin\Http\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
     * @return StreamTransfer|JsonResponse
     *
     * @throws BadRequestException
     */
    public function createFile(Request $request): FileTransfer|JsonResponse
    {
        $reqContent = json_decode($request->getContent(), true);
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
     * @return ChunkResponseTransfer
     *
     * @throws BadRequestException
     */
    public function uploadFile(Request $request): ChunkResponseTransfer
    {
        $requestContent = json_decode($request->getContent());

        $findChannelRequest = new StreamGetTransfer();
        $findChannelRequest->setStreamId($requestContent?->id);

        $channel = $this->fileClient->getStream($findChannelRequest);

        $contentSize = $request->headers->get('Content-Length', 0);
        $contentRange = $request->headers->get('Content-Range');
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
    }
}
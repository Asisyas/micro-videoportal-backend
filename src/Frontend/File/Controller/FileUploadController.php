<?php

namespace App\Frontend\File\Controller;

use App\Client\File\FileClientInterface;
use App\Frontend\File\Facade\FileFacadeInterface;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\ChunkTransfer;
use App\Shared\Generated\DTO\File\FileCreatedTransfer;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use Micro\Plugin\Http\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FileUploadController
{

    /**
     * @param FileClientInterface $fileClient
     * @param FilesystemFacadeInterface $filesystemFacade
     */
    public function __construct(
        private readonly FileClientInterface $fileClient,
        private readonly FilesystemFacadeInterface $filesystemFacade
    )
    {
    }

    /**
     * @param Request $request
     *
     * @return FileTransfer
     *
     * @throws BadRequestException
     */
    public function uploadFile(Request $request): FileTransfer
    {
        $fileCreateTransfer = new FileCreateTransfer();

        $fileCreateTransfer->setContentType($request->headers->get('Content-Type'));
        $fileCreateTransfer->setName($request->headers->get('X-File-Name'));
        $fileCreateTransfer->setSize((int) $request->headers->get('Content-Length'));
        $fileCreatedTransfer = $this->fileClient->createFile($fileCreateTransfer);

        $stream = fopen('php://input', 'r');
        $fs = $this->filesystemFacade->createFsOperator();
        $fs->writeStream($fileCreatedTransfer->getId(), $stream);
        fclose($stream);

        return $this->fileClient->lookupFile((new FileGetTransfer())->setId($fileCreatedTransfer->getId()));
    }
}
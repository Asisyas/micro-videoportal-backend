<?php

namespace App\Client\File\Uploader\Local;

use App\Client\File\Reader\FileClientReaderInterface;
use App\Client\File\Uploader\FileUploaderInterface;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\ChunkTransfer;
use App\Shared\Generated\DTO\File\FileGetTransfer;

class FileUploader implements FileUploaderInterface
{
    /**
     * @param FileClientReaderInterface $fileClientReader
     */
    public function __construct(
        private readonly FileClientReaderInterface $fileClientReader
    )
    {
    }

    /**
     * TODO: Temporary solution
     *
     * {@inheritDoc}
     */
    public function upload(ChunkTransfer $chunkTransfer): ChunkResponseTransfer
    {
        $fileGetTransfer = new FileGetTransfer();
        $fileGetTransfer->setId($chunkTransfer->getFileId());

        $fileTransfer = $this->fileClientReader->lookup($fileGetTransfer);
        $fileDestination = $fileTransfer->getFilePathInternal();
        $fileDestinationPath = dirname($fileDestination);


        if(!file_exists($fileDestinationPath)) {
            mkdir($fileDestinationPath);
        }

        if(!file_exists($fileDestination)) {
            file_put_contents($fileDestination, '');
        }

        $stream = fopen($fileDestination, 'w');

        fseek($stream, $chunkTransfer->getOffset());
        fwrite($stream, $chunkTransfer->getBlob(), $chunkTransfer->getSize());
        fclose($stream);

        $fileSize = filesize($fileDestination);

        $chunkResponseTransfer = new ChunkResponseTransfer();
        $chunkResponseTransfer->setFileId($fileTransfer->getId());
        $chunkResponseTransfer->setSizeLoaded($fileSize);
        $chunkResponseTransfer->setSizeRemaining($fileTransfer->getSize() - $fileSize);

        return $chunkResponseTransfer;
    }
}
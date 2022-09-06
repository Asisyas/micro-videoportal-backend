<?php

namespace App\Client\File\Uploader\Local;

use App\Client\File\Reader\FileClientReaderInterface;
use App\Client\File\Uploader\FileUploaderInterface;
use App\Shared\Generated\DTO\File\ChunkResponseTransfer;
use App\Shared\Generated\DTO\File\ChunkTransfer;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;

class FileUploader implements FileUploaderInterface
{
    /**
     * @param FileClientReaderInterface $fileClientReader
     * @param string $dirTmp
     */
    public function __construct(
        private readonly FileClientReaderInterface $fileClientReader,
        private readonly string $dirTmp
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
        $fileDestination = $this->getFileDestination($fileTransfer);

        if(!file_exists($this->dirTmp)) {
            mkdir($this->dirTmp);
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

    /**
     * @param FileTransfer $fileTransfer
     * @return string
     */
    protected function getFileDestination(FileTransfer $fileTransfer): string
    {
        return $this->dirTmp . DIRECTORY_SEPARATOR . $fileTransfer->getId();
    }
}
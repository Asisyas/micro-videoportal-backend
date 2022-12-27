<?php

namespace App\Backend\File\Saga;

use App\Backend\File\Facade\FileFacadeInterface;
use App\Shared\File\Saga\FileActivityInterface;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;

class FileActivity implements FileActivityInterface
{
    /**
     * @param FileFacadeInterface $fileFacade
     */
    public function __construct(private readonly FileFacadeInterface $fileFacade)
    {
    }

    /**
     * @param FileUploadTransfer $fileUploadTransfer
     *
     * @return FileTransfer
     */
    public function createFile(FileUploadTransfer $fileUploadTransfer): FileTransfer
    {
        return $this->fileFacade->createFile($fileUploadTransfer);
    }
}

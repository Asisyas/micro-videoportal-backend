<?php

namespace App\Backend\VideoConverter\Business\Converter;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertResultTransfer;

interface VideoConverterInterface
{
    /**
     * @param FileTransfer $fileTransfer
     * @param ResolutionTransfer $resolutionTransfer
     *
     * @return VideoConvertResultTransfer
     */
    public function convert(FileTransfer $fileTransfer, ResolutionTransfer $resolutionTransfer): VideoConvertResultTransfer;
}
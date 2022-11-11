<?php

namespace App\Backend\VideoConverter\Business\Converter;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\ResolutionSimpleTransfer;
use App\Shared\Generated\DTO\Video\ResolutionTransfer;

interface VideoConverterInterface
{
    /**
     * @param FileTransfer $fileTransfer
     * @param ResolutionTransfer $resolutionTransfer
     *
     * @return ResolutionSimpleTransfer
     */
    public function convert(FileTransfer $fileTransfer, ResolutionTransfer $resolutionTransfer): ResolutionSimpleTransfer;
}
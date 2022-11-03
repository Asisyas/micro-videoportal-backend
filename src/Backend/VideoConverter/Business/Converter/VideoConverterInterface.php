<?php

namespace App\Backend\VideoConverter\Business\Converter;

use App\Shared\Generated\DTO\VideoConverter\VideoConvertResultTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertTransfer;

interface VideoConverterInterface
{
    /**
     * @param VideoConvertTransfer $videoConvertTransfer
     *
     * @return mixed
     */
    public function convert(VideoConvertTransfer $videoConvertTransfer): VideoConvertResultTransfer;
}
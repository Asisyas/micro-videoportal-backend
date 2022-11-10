<?php

namespace App\Client\Video\Reader;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

interface VideoReaderInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return VideoTransfer
     */
    public function lookup(VideoGetTransfer $videoGetTransfer): VideoTransfer;
}
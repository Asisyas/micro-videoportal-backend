<?php

namespace App\Client\Video\Reader;

use App\Shared\Generated\DTO\Video\VideoWatchTRansfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

interface VideoReaderInterface
{
    /**
     * @param VideoWatchTRansfer $videoGetTransfer
     *
     * @return VideoTransfer
     */
    public function lookup(VideoWatchTRansfer $videoGetTransfer): VideoTransfer;
}
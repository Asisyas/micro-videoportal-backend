<?php

namespace App\Client\Video\Reader;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

interface VideoReaderInterface
{
    /**
     * @param VideoWatchTransfer $videoGetTransfer
     *
     * @return VideoTransfer
     *
     * @throws NotFoundException
     */
    public function lookup(VideoWatchTransfer $videoGetTransfer): VideoTransfer;
}

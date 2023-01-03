<?php

namespace App\Client\Video\Reader;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

interface VideoReaderInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return VideoTransfer
     *
     * @throws NotFoundException
     */
    public function lookup(VideoGetTransfer $videoGetTransfer): VideoTransfer;
}

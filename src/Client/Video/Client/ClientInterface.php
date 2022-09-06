<?php

namespace App\Client\Video\Client;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

interface ClientInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return VideoTransfer
     */
    public function getVideo(VideoGetTransfer $videoGetTransfer): VideoTransfer;
}
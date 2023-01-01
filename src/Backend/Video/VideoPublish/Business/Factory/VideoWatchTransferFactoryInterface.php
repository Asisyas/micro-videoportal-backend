<?php

namespace App\Backend\Video\VideoPublish\Business\Factory;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;

interface VideoWatchTransferFactoryInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return VideoWatchTransfer
     */
    public function create(VideoGetTransfer $videoGetTransfer): VideoWatchTransfer;
}

<?php

namespace App\Client\Video\Client;

use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

interface VideoClientInterface
{
    /**
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return VideoTransfer
     */
    public function createVideo(VideoCreateTransfer $videoCreateTransfer): VideoTransfer;

    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return VideoTransfer
     */
    public function lookupVideo(VideoGetTransfer $videoGetTransfer): VideoTransfer;
}
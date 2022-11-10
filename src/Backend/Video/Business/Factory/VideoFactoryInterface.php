<?php

namespace App\Backend\Video\Business\Factory;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

interface VideoFactoryInterface
{
    /**
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return VideoTransfer
     */
    public function create(VideoCreateTransfer $videoCreateTransfer): VideoTransfer;
}
<?php

namespace App\Backend\Video\Business\Factory;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use App\Shared\Video\Exception\VideoNotFoundException;

interface VideoFactoryInterface
{
    /**
     * @param VideoCreateTransfer $videoCreateTransfer
     *
     * @return VideoTransfer
     */
    public function create(VideoCreateTransfer $videoCreateTransfer): VideoTransfer;

    /**
     * @param VideoTransfer $videoTransfer
     *
     * @return VideoTransfer
     *
     * @throws VideoNotFoundException
     */
    public function update(VideoTransfer $videoTransfer): VideoTransfer;
}
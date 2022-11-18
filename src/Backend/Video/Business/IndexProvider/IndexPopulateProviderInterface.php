<?php

namespace App\Backend\Video\Business\IndexProvider;

use App\Shared\Generated\DTO\Video\VideoTransfer;

interface IndexPopulateProviderInterface
{
    /**
     * @param VideoTransfer $videoTransfer
     *
     * @return void
     */
    public function populate(VideoTransfer $videoTransfer): void;
}
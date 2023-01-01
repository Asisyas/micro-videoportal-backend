<?php

namespace App\Backend\Video\VideoPublish\Facade;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;

interface VideoPublishFacadeInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return void
     */
    public function propagateVideo(VideoGetTransfer $videoGetTransfer): void;
}

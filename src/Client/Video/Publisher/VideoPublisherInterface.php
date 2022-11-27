<?php

namespace App\Client\Video\Publisher;

use App\Shared\Generated\DTO\Video\VideoPublishTransfer;

interface VideoPublisherInterface
{
    /**
     * @param VideoPublishTransfer $videoPublishTransfer
     *
     * @return void
     */
    public function publish(VideoPublishTransfer $videoPublishTransfer): void;
}
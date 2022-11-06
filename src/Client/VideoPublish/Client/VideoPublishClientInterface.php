<?php

namespace App\Client\VideoPublish\Client;

use App\Shared\Generated\DTO\Video\VideoPublishTransfer;

interface VideoPublishClientInterface
{
    /**
     * @param VideoPublishTransfer $videoPublishTransfer
     *
     * @return mixed
     */
    public function publish(VideoPublishTransfer $videoPublishTransfer);
}
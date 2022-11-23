<?php

namespace App\Frontend\VideoPublish\Factory;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoPublishTransferFactory implements VideoPublishTransferFactoryInterface
{
    public function __construct()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createFromRequest(Request $request): VideoPublishTransfer
    {
        $channelId = $request->query->get('channel_id');
        $fileId = $request->query->get('file_id');

        $videoPublishTransfer = new VideoPublishTransfer();

        return $videoPublishTransfer
            ->setChannelId($channelId)
            ->setFileId($fileId);
    }
}
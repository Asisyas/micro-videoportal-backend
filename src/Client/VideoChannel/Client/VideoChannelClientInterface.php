<?php

namespace App\Client\VideoChannel\Client;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelVideosGetTransfer;

interface VideoChannelClientInterface
{
    /**
     * @param VideoChannelCreateTransfer $videoChannelCreateTransfer
     *
     * @return VideoChannelTransfer
     */
    public function createChannel(VideoChannelCreateTransfer $videoChannelCreateTransfer): VideoChannelTransfer;

    /**
     * @param VideoChannelGetTransfer $videoChannelGetTransfer
     *
     * @return VideoChannelTransfer
     *
     * @throws NotFoundException
     */
    public function lookupChannel(VideoChannelGetTransfer $videoChannelGetTransfer): VideoChannelTransfer;

    /**
     * @param VideoChannelGetTransfer $videoChannelGetTransfer
     *
     * @return VideoChannelTransfer
     *
     * @throws NotFoundException
     */
    public function lookupUserChannel(VideoChannelGetTransfer $videoChannelGetTransfer): VideoChannelTransfer;

    /**
     * @param VideoChannelVideosGetTransfer $videoChannelGetTransfer
     *
     * @return SearchResultCollectionTransfer
     *
     * @throws NotFoundException
     */
    public function lookupVideos(VideoChannelVideosGetTransfer $videoChannelGetTransfer): SearchResultCollectionTransfer;
}

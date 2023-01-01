<?php

namespace App\Frontend\VideoChannel\Controller;

use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use App\Frontend\VideoChannel\Facade\VideoChannelFacadeInterface;
use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelVideosGetTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoChannelController
{
    /**
     * @param VideoChannelFacadeInterface $videoChannelFacade
     * @param ClientVideoChannelInterface $videoChannelClient
     */
    public function __construct(
        private readonly VideoChannelFacadeInterface $videoChannelFacade,
        private readonly ClientVideoChannelInterface $videoChannelClient
    ) {
    }

    /**
     * @param Request $request
     *
     * @return VideoChannelTransfer
     */
    public function createChannel(Request $request): VideoChannelTransfer
    {
        return $this->videoChannelFacade->handleChannelCreateFromRequest($request);
    }

    /**
     * @param Request $request
     *
     * @return VideoChannelTransfer
     */
    public function lookupChannel(Request $request): VideoChannelTransfer
    {
        return $this->videoChannelFacade->handleLookupChannel($request);
    }

    /**
     * @param Request $request
     *
     * @return SearchResultCollectionTransfer
     */
    public function channelVideos(Request $request): SearchResultCollectionTransfer
    {
        $videosGetTransfer = new VideoChannelVideosGetTransfer();
        $videosGetTransfer
            ->setChannelId($request->get('channel_id'))
            ->setLimit((int) $request->query->get('limit', 50))
            ->setOffset((int) $request->query->get('offset', 0))
        ;

        return $this->videoChannelClient->lookupVideos($videosGetTransfer);
    }
}

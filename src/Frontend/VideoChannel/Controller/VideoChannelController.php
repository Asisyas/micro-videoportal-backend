<?php

namespace App\Frontend\VideoChannel\Controller;

use App\Client\VideoChannel\Client\VideoChannelClientInterface;
use App\Frontend\VideoChannel\Facade\VideoChannelFacadeInterface;
use App\Shared\Generated\DTO\Search\SearchResultCollectionTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelVideosGetTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoChannelController
{
    /**
     * @param VideoChannelFacadeInterface $videoChannelFacade
     * @param VideoChannelClientInterface $videoChannelClient
     */
    public function __construct(
        private readonly VideoChannelFacadeInterface $videoChannelFacade,
        private readonly VideoChannelClientInterface $videoChannelClient
    )
    {
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
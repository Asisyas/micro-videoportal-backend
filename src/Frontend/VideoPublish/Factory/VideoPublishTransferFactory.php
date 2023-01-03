<?php

namespace App\Frontend\VideoPublish\Factory;

use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use App\Frontend\Security\Facade\SecurityFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoPublishTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoPublishTransferFactory implements VideoPublishTransferFactoryInterface
{
    public function __construct(
        private readonly SecurityFacadeInterface $securityFacade,
        private readonly ClientVideoChannelInterface $clientVideoChannel
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function createFromRequest(Request $request): VideoPublishTransfer
    {
        $token = $this->securityFacade->getAuthToken();
        $fileId = (string) $request->query->get('file_id');
        $videoChannelGetTransfer = new VideoChannelGetTransfer();

        $videoChannelGetTransfer->setOwnerId($token->getUserId());

        $channel = $this->clientVideoChannel->lookupUserChannel($videoChannelGetTransfer);
        $channelId = $channel->getId();

        $videoPublishTransfer = new VideoPublishTransfer();

        return $videoPublishTransfer
            ->setChannelId($channelId)
            ->setFileId($fileId);
    }
}

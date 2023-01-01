<?php

declare(strict_types=1);

/**
 * This file is part of the Micro framework package.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Frontend\VideoChannel\Handler\Lookup;

use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use App\Frontend\Security\Facade\SecurityFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ChannelLookupRequestHandler implements ChannelLookupRequestHandlerInterface
{
    /**
     * @param ClientVideoChannelInterface $clientVideoChannel
     * @param SecurityFacadeInterface $securityFacade
     */
    public function __construct(
        private readonly ClientVideoChannelInterface $clientVideoChannel,
        private readonly SecurityFacadeInterface     $securityFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function handleLookupChannel(Request $request): VideoChannelTransfer
    {
        $channelId = $request->get('channel_id');
        $ownerId = $this->securityFacade->getAuthToken()->getUserId();
        $videoChannelGetTransfer = new VideoChannelGetTransfer();
        $videoChannelGetTransfer
            ->setChannelId($channelId)
            ->setOwnerId($ownerId);

        if (!$channelId) {
            return $this->clientVideoChannel->lookupUserChannel($videoChannelGetTransfer);
        }

        return $this->clientVideoChannel->lookupChannel($videoChannelGetTransfer);
    }
}

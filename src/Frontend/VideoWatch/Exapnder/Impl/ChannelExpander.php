<?php

declare(strict_types=1);

/**
 * This file is part of the Video portal application
 * based on the Micro Framework.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Frontend\VideoWatch\Exapnder\Impl;

use App\Client\VideoChannel\Client\VideoChannelClientInterface;
use App\Frontend\VideoWatch\Exapnder\VideoWatchExpanderInterface;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ChannelExpander implements VideoWatchExpanderInterface
{
    /**
     * @param VideoChannelClientInterface $videoChannelClient
     */
    public function __construct(
        private readonly VideoChannelClientInterface $videoChannelClient
    ) {
    }

    /**
     * @param VideoWatchTransfer $videoWatchTransfer
     *
     * @return void
     */
    public function expand(VideoWatchTransfer $videoWatchTransfer): void
    {
        $channelId = $videoWatchTransfer->getChannelId();
        if (!$channelId) {
            return;
        }

        $channelGetTransfer = (new VideoChannelGetTransfer())
            ->setChannelId($videoWatchTransfer->getChannelId());

        $channelTransfer = $this->videoChannelClient->lookupChannel($channelGetTransfer);

        $videoWatchTransfer->setChannel($channelTransfer);
    }
}

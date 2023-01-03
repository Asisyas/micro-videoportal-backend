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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderChannel\Expander;

use App\Client\ClientReader\Exception\NotFoundException;
use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderInterface;
use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoChannelExpander implements VideoTransferExpanderInterface
{
    public function __construct(
        private readonly ClientVideoChannelInterface $clientVideoChannel
    ) {
    }

    /**
     * @param VideoTransfer $videoTransfer
     */
    public function expand(VideoTransfer $videoTransfer): void
    {
        $videoChannelGetTransfer = new VideoChannelGetTransfer();
        $videoChannelGetTransfer->setChannelId($videoTransfer->getChannelId());

        try {
            $channelTransfer = $this->clientVideoChannel->lookupChannel($videoChannelGetTransfer);
            $videoTransfer->setChannel($channelTransfer);
        } catch (NotFoundException $exception) {
        }
    }
}

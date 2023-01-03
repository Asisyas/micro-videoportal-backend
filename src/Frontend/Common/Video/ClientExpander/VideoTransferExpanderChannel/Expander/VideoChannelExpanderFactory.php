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

use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderFactoryInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoChannelExpanderFactory implements VideoTransferExpanderFactoryInterface
{
    /**
     * @param ClientVideoChannelInterface $clientVideoChannel
     */
    public function __construct(
        private readonly ClientVideoChannelInterface $clientVideoChannel
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoTransferExpanderInterface
    {
        return new VideoChannelExpander($this->clientVideoChannel);
    }
}

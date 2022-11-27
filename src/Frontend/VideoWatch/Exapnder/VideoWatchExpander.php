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

namespace App\Frontend\VideoWatch\Exapnder;

use App\Shared\Generated\DTO\Video\VideoWatchTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoWatchExpander implements VideoWatchExpanderInterface
{
    /**
     * @param iterable<VideoWatchExpanderInterface> $expanderCollection
     */
    public function __construct(
        private readonly iterable $expanderCollection
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(VideoWatchTransfer $videoWatchTransfer): void
    {
        foreach ($this->expanderCollection as $expander) {
            $expander->expand($videoWatchTransfer);
        }
    }
}
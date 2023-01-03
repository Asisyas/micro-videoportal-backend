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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander;

use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Plugin\VideoTransferExpanderPluginInterface;
use App\Shared\Generated\DTO\Video\VideoTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoTransferExpander implements VideoTransferExpanderInterface
{
    /**
     * @param iterable<VideoTransferExpanderPluginInterface> $videoExpanderCollection
     */
    public function __construct(
        private readonly iterable $videoExpanderCollection
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(VideoTransfer $videoTransfer): void
    {
        foreach ($this->videoExpanderCollection as $expander) {
            $expander
                ->createVideoTransferExpanderFactory()
                ->create()
                ->expand($videoTransfer);
        }
    }
}

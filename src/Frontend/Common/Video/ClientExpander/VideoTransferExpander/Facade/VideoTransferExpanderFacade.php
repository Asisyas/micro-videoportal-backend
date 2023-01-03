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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Facade;

use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoTransferExpanderFacade implements VideoTransferExpanderFacadeInterface
{
    public function __construct(
        private readonly VideoTransferExpanderFactoryInterface $videoTransferExpanderFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(VideoTransfer $videoTransfer): void
    {
        $this->videoTransferExpanderFactory
            ->create()
            ->expand($videoTransfer);
    }
}

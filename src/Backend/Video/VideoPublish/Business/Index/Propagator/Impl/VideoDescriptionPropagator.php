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

namespace App\Backend\Video\VideoPublish\Business\Index\Propagator\Impl;

use App\Backend\Video\VideoDescription\Facade\VideoDescriptionFacadeInterface;
use App\Backend\Video\VideoPublish\Business\Index\Propagator\IndexPropagatorInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoDescriptionPropagator implements IndexPropagatorInterface
{
    public function __construct(
        private readonly VideoDescriptionFacadeInterface $videoDescriptionFacade
    ) {
    }

    public function propagate(VideoTransfer $videoTransfer): void
    {
        $videoGetTransfer = new VideoGetTransfer();
        $videoGetTransfer->setVideoId($videoTransfer->getId());

        $this->videoDescriptionFacade->propagate($videoGetTransfer);
    }
}

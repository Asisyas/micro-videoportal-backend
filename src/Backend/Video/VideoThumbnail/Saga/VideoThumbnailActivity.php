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

namespace App\Backend\Video\VideoThumbnail\Saga;

use App\Backend\Video\VideoThumbnail\Facade\VideoThumbnailFacadeInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\VideoThumbnail\Saga\VideoThumbnailActivityInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoThumbnailActivity implements VideoThumbnailActivityInterface
{
    /**
     * @param VideoThumbnailFacadeInterface $videoThumbnailGeneratorFacade
     */
    public function __construct(
        private readonly VideoThumbnailFacadeInterface $videoThumbnailGeneratorFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function generateThumbnail(VideoGetTransfer $videoGetTransfer)
    {
        return $this->videoThumbnailGeneratorFacade->generateThumbnail($videoGetTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function cleanUnusedThumbnails(VideoGetTransfer $videoGetTransfer)
    {
        return true;
    }
}

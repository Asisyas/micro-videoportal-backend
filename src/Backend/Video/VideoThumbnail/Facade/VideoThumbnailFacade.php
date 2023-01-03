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

namespace App\Backend\Video\VideoThumbnail\Facade;

use App\Backend\Video\VideoThumbnail\Business\Generator\ThumbnailGeneratorFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoThumbnailGeneratedTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoThumbnailFacade implements VideoThumbnailFacadeInterface
{
    /**
     * @param ThumbnailGeneratorFactoryInterface $thumbnailGeneratorFactory
     */
    public function __construct(
        private readonly ThumbnailGeneratorFactoryInterface $thumbnailGeneratorFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function generateThumbnail(VideoGetTransfer $videoGetTransfer): VideoThumbnailGeneratedTransfer
    {
        return $this->thumbnailGeneratorFactory
            ->create()
            ->generateThumbnail($videoGetTransfer);
    }
}

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

namespace App\Backend\Video\VideoThumbnail\Business\Generator;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoThumbnailGeneratedTransfer;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
interface ThumbnailGeneratorInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return VideoThumbnailGeneratedTransfer
     */
    public function generateThumbnail(VideoGetTransfer $videoGetTransfer): VideoThumbnailGeneratedTransfer;
}

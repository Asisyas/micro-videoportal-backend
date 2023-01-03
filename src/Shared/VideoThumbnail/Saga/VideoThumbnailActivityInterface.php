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

namespace App\Shared\VideoThumbnail\Saga;

use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use Micro\Plugin\Temporal\Activity\ActivityInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
#[\Temporal\Activity\ActivityInterface(prefix: 'video.thumbail_')]
interface VideoThumbnailActivityInterface extends ActivityInterface
{
    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return mixed
     */
    public function generateThumbnail(VideoGetTransfer $videoGetTransfer);

    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return mixed
     */
    public function cleanUnusedThumbnails(VideoGetTransfer $videoGetTransfer);
}

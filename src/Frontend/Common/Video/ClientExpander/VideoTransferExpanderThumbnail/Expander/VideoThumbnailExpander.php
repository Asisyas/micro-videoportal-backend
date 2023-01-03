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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderThumbnail\Expander;

use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderInterface;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use League\Flysystem\FilesystemOperator;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoThumbnailExpander implements VideoTransferExpanderInterface
{
    /**
     * @param FilesystemOperator $filesystemOperator
     */
    public function __construct(
        private readonly FilesystemOperator $filesystemOperator
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(VideoTransfer $videoTransfer): void
    {
        $thumbnailFile = sprintf('%s.thumbnail.png', $videoTransfer->getId());
        if (!$this->filesystemOperator->fileExists($thumbnailFile)) {
            return;
        }

        $expiredAt = new \DateTime('+3 minutes');
        $url = $this->filesystemOperator->temporaryUrl($thumbnailFile, $expiredAt);

        $videoTransfer->setThumbnail($url);
    }
}

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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderSrc\Expander;

use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderInterface;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use League\Flysystem\FilesystemOperator;
use Nette\Utils\DateTime;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoSourceExpander implements VideoTransferExpanderInterface
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
        $sourceUrl = sprintf('%s.stream.mpd', $videoTransfer->getId());

        $videoTransfer->setSrc(
            $this->filesystemOperator->temporaryUrl(
                $sourceUrl,
                new DateTime('+2 minutes'),
            )
        );
    }
}

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

namespace App\Frontend\VideoWatch\Exapnder\Impl;

use App\Frontend\VideoWatch\Exapnder\VideoWatchExpanderInterface;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class SrcExpander implements VideoWatchExpanderInterface
{
    /**
     * @param FilesystemFacadeInterface $filesystemFacade
     */
    public function __construct(
        private readonly FilesystemFacadeInterface $filesystemFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function expand(VideoWatchTransfer $videoWatchTransfer): void
    {
        $src = $videoWatchTransfer->getSrc();
        if (!$src) {
            return;
        }

        $fs = $this->filesystemFacade->createFsOperator();
        $videoWatchTransfer->setSrc(
            $fs->temporaryUrl(
                $src,
                (new \DateTime('now'))->modify('+30 seconds')
            ),
        );
    }
}

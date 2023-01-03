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

use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ThumbnailGeneratorFactory implements ThumbnailGeneratorFactoryInterface
{
    /**
     * @param FilesystemFacadeInterface $filesystemFacade
     *
     * @param FfmpegFacadeInterface $ffmpegFacade
     */
    public function __construct(
        private readonly FilesystemFacadeInterface $filesystemFacade,
        private readonly FfmpegFacadeInterface $ffmpegFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ThumbnailGeneratorInterface
    {
        return new ThumbnailGenerator(
            $this->filesystemFacade->createFsOperator(),
            $this->ffmpegFacade
        );
    }
}

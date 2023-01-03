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

use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderFactoryInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoThumbnailExpanderFactory implements VideoTransferExpanderFactoryInterface
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
    public function create(): VideoTransferExpanderInterface
    {
        return new VideoThumbnailExpander($this->filesystemFacade->createFsOperator());
    }
}

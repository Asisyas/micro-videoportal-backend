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

namespace App\Backend\Video;

use App\Backend\Video\Video\VideoPlugin;
use App\Backend\Video\VideoDescription\VideoDescriptionPlugin;
use App\Backend\Video\VideoPublish\VideoPublishPlugin;
use App\Backend\Video\VideoThumbnail\VideoThumbnailPlugin;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderThumbnail\VideoTransferExpanderThumbnailPlugin;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoPackPlugin implements PluginDependedInterface
{
    /**
     * {@inheritDoc}
     */
    public function getDependedPlugins(): iterable
    {
        return [
            VideoPublishPlugin::class,
            VideoDescriptionPlugin::class,
            VideoPlugin::class,
            VideoThumbnailPlugin::class,

            VideoTransferExpanderThumbnailPlugin::class,
        ];
    }
}

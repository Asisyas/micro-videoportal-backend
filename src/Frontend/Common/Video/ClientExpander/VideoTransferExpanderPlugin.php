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

namespace App\Frontend\Common\Video\ClientExpander;

use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderChannel\VideoTransferExpanderChannelPlugin;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderDescription\VideoTransferExpanderDescriptionPlugin;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderSrc\VideoTransferExpanderSourcePlugin;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\VideoTransferExpanderPlugin as VideoTransferExpanderFacadePlugin;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoTransferExpanderPlugin implements PluginDependedInterface
{
    /**
     * {@inheritDoc}
     */
    public function getDependedPlugins(): iterable
    {
        return [
            VideoTransferExpanderFacadePlugin::class,

            VideoTransferExpanderChannelPlugin::class,
            VideoTransferExpanderSourcePlugin::class,
            VideoTransferExpanderSourcePlugin::class,
            VideoTransferExpanderDescriptionPlugin::class,
        ];
    }
}

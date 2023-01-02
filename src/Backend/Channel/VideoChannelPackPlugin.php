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

namespace App\Backend\Channel;

use App\Backend\Channel\VideoChannel\VideoChannelPlugin;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoChannelPackPlugin implements PluginDependedInterface
{
    /**
     * {@inheritDoc}
     */
    public function getDependedPlugins(): iterable
    {
        return [
            VideoChannelPlugin::class,
        ];
    }
}

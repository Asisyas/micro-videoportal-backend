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

namespace App\Client;

use App\Client\ClientReader\ClientReaderPlugin;
use App\Client\File\ClientFilePlugin;
use App\Client\Search\ClientSearchPlugin;
use App\Client\Security\ClientSecurityPlugin;
use App\Client\Video\ClientVideoPlugin;
use App\Client\VideoChannel\ClientVideoChannelPlugin;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ClientPlugin implements PluginDependedInterface
{
    /**
     * {@inheritDoc}
     */
    public function getDependedPlugins(): iterable
    {
        return [
            ClientFilePlugin::class,
            ClientReaderPlugin::class,
            ClientSearchPlugin::class,
            ClientSecurityPlugin::class,
            ClientVideoPlugin::class,
            ClientVideoChannelPlugin::class,
        ];
    }
}

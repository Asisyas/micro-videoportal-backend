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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderChannel;

use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderFactoryInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Plugin\VideoTransferExpanderPluginInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderChannel\Expander\VideoChannelExpanderFactory;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoTransferExpanderChannelPlugin implements DependencyProviderInterface, VideoTransferExpanderPluginInterface
{
    /**
     * @var Container
     */
    private readonly Container $container;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function createVideoTransferExpanderFactory(): VideoTransferExpanderFactoryInterface
    {
        return new VideoChannelExpanderFactory($this->lookupClientChannel());
    }

    /**
     * @return ClientVideoChannelInterface
     */
    protected function lookupClientChannel(): ClientVideoChannelInterface
    {
        return $this->container->get(ClientVideoChannelInterface::class);
    }
}

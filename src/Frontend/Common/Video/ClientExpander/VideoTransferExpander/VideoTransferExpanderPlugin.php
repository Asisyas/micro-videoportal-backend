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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpander;

use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderFactory;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderFactoryInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Facade\VideoTransferExpanderFacade;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Facade\VideoTransferExpanderFacadeInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderChannel\VideoTransferExpanderChannelPlugin;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderDescription\VideoTransferExpanderDescriptionPlugin;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderSrc\VideoTransferExpanderSourcePlugin;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderThumbnail\VideoTransferExpanderThumbnailPlugin;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\KernelInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoTransferExpanderPlugin implements DependencyProviderInterface, PluginDependedInterface
{
    /**
     * @var KernelInterface
     */
    private readonly KernelInterface $kernel;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoTransferExpanderFacadeInterface::class, function (
            KernelInterface $kernel
        ) {
            $this->kernel = $kernel;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoTransferExpanderFacadeInterface
     */
    protected function createFacade(): VideoTransferExpanderFacadeInterface
    {
        return new VideoTransferExpanderFacade(
            $this->createVideoTransferExpanderFactory()
        );
    }

    /**
     * @return VideoTransferExpanderFactoryInterface
     */
    protected function createVideoTransferExpanderFactory(): VideoTransferExpanderFactoryInterface
    {
        return new VideoTransferExpanderFactory($this->kernel);
    }

    public function getDependedPlugins(): iterable
    {
        return [
            VideoTransferExpanderThumbnailPlugin::class,
            VideoTransferExpanderSourcePlugin::class,
            VideoTransferExpanderChannelPlugin::class,
            VideoTransferExpanderDescriptionPlugin::class,
        ];
    }
}

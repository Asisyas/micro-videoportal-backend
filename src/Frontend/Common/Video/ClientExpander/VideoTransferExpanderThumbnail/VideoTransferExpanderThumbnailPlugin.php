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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderThumbnail;

use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderFactoryInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Plugin\VideoTransferExpanderPluginInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderThumbnail\Expander\VideoThumbnailExpanderFactory;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoTransferExpanderThumbnailPlugin implements VideoTransferExpanderPluginInterface, DependencyProviderInterface
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

    public function createVideoTransferExpanderFactory(): VideoTransferExpanderFactoryInterface
    {
        return new VideoThumbnailExpanderFactory($this->lookupFilesystemFacade());
    }

    /**
     * @return FilesystemFacadeInterface
     */
    protected function lookupFilesystemFacade(): FilesystemFacadeInterface
    {
        return $this->container->get(FilesystemFacadeInterface::class);
    }
}

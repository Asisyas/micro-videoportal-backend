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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderSrc;

use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderFactoryInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Plugin\VideoTransferExpanderPluginInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderSrc\Expander\VideoSourceExpanderFactory;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoTransferExpanderSourcePlugin implements VideoTransferExpanderPluginInterface, DependencyProviderInterface
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
        $filesystemFacade = $this->container->get(FilesystemFacadeInterface::class);

        return new VideoSourceExpanderFactory($filesystemFacade);
    }
}

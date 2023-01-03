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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderDescription;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderFactoryInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Plugin\VideoTransferExpanderPluginInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderDescription\Expander\VideoDescriptionExpanderFactory;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoTransferExpanderDescriptionPlugin implements VideoTransferExpanderPluginInterface, DependencyProviderInterface
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
        return new VideoDescriptionExpanderFactory($this->lookupStorageReaderClient());
    }

    /**
     * {@inheritDoc}
     */
    protected function lookupStorageReaderClient(): ClientReaderFacadeInterface
    {
        return $this->container->get(ClientReaderFacadeInterface::class);
    }
}

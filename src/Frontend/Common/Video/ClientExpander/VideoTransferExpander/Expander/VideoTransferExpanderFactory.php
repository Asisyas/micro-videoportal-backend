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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander;

use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Plugin\VideoTransferExpanderPluginInterface;
use Micro\Framework\Kernel\KernelInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoTransferExpanderFactory implements VideoTransferExpanderFactoryInterface
{
    public function __construct(
        private readonly KernelInterface $kernel
    ) {
    }

    /**
     * @return VideoTransferExpanderInterface
     */
    public function create(): VideoTransferExpanderInterface
    {
        /** @var VideoTransferExpanderPluginInterface[] $plugins */
        $plugins = $this->kernel->plugins(VideoTransferExpanderPluginInterface::class);

        return new VideoTransferExpander($plugins);
    }
}

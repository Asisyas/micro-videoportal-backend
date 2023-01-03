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

namespace App\Frontend\Common\Video\ClientExpander\VideoTransferExpanderDescription\Expander;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderFactoryInterface;
use App\Frontend\Common\Video\ClientExpander\VideoTransferExpander\Expander\VideoTransferExpanderInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class VideoDescriptionExpanderFactory implements VideoTransferExpanderFactoryInterface
{
    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     */
    public function __construct(
        private readonly ClientReaderFacadeInterface $clientReaderFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoTransferExpanderInterface
    {
        return new VideoDescriptionExpander(
            $this->clientReaderFacade
        );
    }
}

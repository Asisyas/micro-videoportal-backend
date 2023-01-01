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

namespace App\Frontend\VideoChannel\Handler\Lookup;

use App\Client\VideoChannel\Client\ClientVideoChannelInterface;
use App\Frontend\Security\Facade\SecurityFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ChannelLookupRequestHandlerFactory implements ChannelLookupRequestHandlerFactoryInterface
{
    /**
     * @param ClientVideoChannelInterface $videoChannelClient
     * @param SecurityFacadeInterface $securityFacade
     */
    public function __construct(
        private readonly ClientVideoChannelInterface $videoChannelClient,
        private readonly SecurityFacadeInterface $securityFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ChannelLookupRequestHandlerInterface
    {
        return new ChannelLookupRequestHandler(
            $this->videoChannelClient,
            $this->securityFacade
        );
    }
}

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

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
interface ChannelLookupRequestHandlerFactoryInterface
{
    /**
     * @return ChannelLookupRequestHandlerInterface
     */
    public function create(): ChannelLookupRequestHandlerInterface;
}

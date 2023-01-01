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

use App\Shared\Generated\DTO\Video\VideoChannelTransfer;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
interface ChannelLookupRequestHandlerInterface
{
    /**
     * @param Request $request
     *
     * @return VideoChannelTransfer
     */
    public function handleLookupChannel(Request $request): VideoChannelTransfer;
}

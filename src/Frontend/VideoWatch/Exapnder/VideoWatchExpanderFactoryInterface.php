<?php

declare(strict_types=1);

/**
 * This file is part of the Video portal application
 * based on the Micro Framework.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Frontend\VideoWatch\Exapnder;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
interface VideoWatchExpanderFactoryInterface
{
    /**
     * @return VideoWatchExpanderInterface
     */
    public function create(): VideoWatchExpanderInterface;
}
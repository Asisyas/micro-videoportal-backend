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
class VideoWatchExpanderFactory implements VideoWatchExpanderFactoryInterface
{
    /**
     * @var iterable<VideoWatchExpanderInterface>
     */
    private readonly iterable $expanderCollection;

    /**
     * @param VideoWatchExpanderInterface ...$expanderCollection
     */
    public function __construct(VideoWatchExpanderInterface ...$expanderCollection)
    {
        $this->expanderCollection = $expanderCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoWatchExpanderInterface
    {
        return new VideoWatchExpander($this->expanderCollection);
    }
}

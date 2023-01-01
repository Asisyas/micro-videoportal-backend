<?php

namespace App\Backend\Video\VideoPublish\Business\Expander;

interface VideoWatchExpanderFactoryInterface
{
    /**
     * @return VideoWatchExpanderInterface
     */
    public function create(): VideoWatchExpanderInterface;
}

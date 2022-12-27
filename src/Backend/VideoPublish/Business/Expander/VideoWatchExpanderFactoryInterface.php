<?php

namespace App\Backend\VideoPublish\Business\Expander;

interface VideoWatchExpanderFactoryInterface
{
    /**
     * @return VideoWatchExpanderInterface
     */
    public function create(): VideoWatchExpanderInterface;
}

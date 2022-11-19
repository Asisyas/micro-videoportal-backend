<?php

namespace App\Backend\VideoPublish\Business\Expander;

class VideoWatchExpanderFactory implements VideoWatchExpanderFactoryInterface
{
    /**
     * @var iterable<VideoWatchExpanderInterface>
     */
    private readonly iterable $videoWatchExpanderCollection;

    public function __construct(VideoWatchExpanderInterface ...$videoWatchExpanderCollection)
    {
        $this->videoWatchExpanderCollection = $videoWatchExpanderCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoWatchExpanderInterface
    {
        return new VideoWatchExpander($this->videoWatchExpanderCollection);
    }
}
<?php

namespace App\Backend\VideoChannel\Business\Expander\Entity;

class VideoChannelEntityExpanderFactory implements VideoChannelEntityExpanderFactoryInterface
{
    /**
     * @var iterable<VideoChannelEntityExpanderInterface>
     */
    private readonly iterable $expanderCollection;

    /**
     * @param VideoChannelEntityExpanderInterface ...$expanderCollection
     */
    public function __construct(
        VideoChannelEntityExpanderInterface ...$expanderCollection
    )
    {
        $this->expanderCollection = $expanderCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoChannelEntityExpanderInterface
    {
        return new VideoChannelEntityExpander($this->expanderCollection);
    }
}
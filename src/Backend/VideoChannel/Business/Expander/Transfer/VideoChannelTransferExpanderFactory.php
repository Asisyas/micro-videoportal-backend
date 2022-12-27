<?php

namespace App\Backend\VideoChannel\Business\Expander\Transfer;

class VideoChannelTransferExpanderFactory implements VideoChannelTransferExpanderFactoryInterface
{
    /**
     * @var iterable<VideoChannelTransferExpanderInterface>
     */
    private readonly iterable $expanderCollection;

    /**
     * @param VideoChannelTransferExpanderInterface ...$expanderCollection
     */
    public function __construct(
        VideoChannelTransferExpanderInterface ...$expanderCollection
    ) {
        $this->expanderCollection = $expanderCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoChannelTransferExpanderInterface
    {
        return new VideoChannelTransferExpander($this->expanderCollection);
    }
}

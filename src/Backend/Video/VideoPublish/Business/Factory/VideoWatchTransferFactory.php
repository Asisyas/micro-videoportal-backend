<?php

namespace App\Backend\Video\VideoPublish\Business\Factory;

use App\Backend\Video\VideoPublish\Business\Expander\VideoWatchExpanderFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;

class VideoWatchTransferFactory implements VideoWatchTransferFactoryInterface
{
    /**
     * @param VideoWatchExpanderFactoryInterface $videoWatchExpanderFactory
     */
    public function __construct(
        private readonly VideoWatchExpanderFactoryInterface $videoWatchExpanderFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(VideoGetTransfer $videoGetTransfer): VideoWatchTransfer
    {
        $videoWatchTransfer = new VideoWatchTransfer();

        $this->videoWatchExpanderFactory
            ->create()
            ->expand($videoWatchTransfer, $videoGetTransfer);

        return $videoWatchTransfer;
    }
}

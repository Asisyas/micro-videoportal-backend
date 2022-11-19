<?php

namespace App\Backend\VideoPublish\Business\Index\Propagator;

use App\Shared\Generated\DTO\Video\VideoWatchTransfer;

interface IndexPropagatorInterface
{
    /**
     * @param VideoWatchTransfer $videoWatchTransfer
     *
     * @return void
     */
    public function propagate(VideoWatchTransfer $videoWatchTransfer): void;
}
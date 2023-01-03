<?php

namespace App\Backend\Video\VideoPublish\Business\Index\Propagator;

use App\Shared\Generated\DTO\Video\VideoTransfer;

interface IndexPropagatorInterface
{
    /**
     * @param VideoTransfer $videoTransfer
     *
     * @return void
     */
    public function propagate(VideoTransfer $videoTransfer): void;
}

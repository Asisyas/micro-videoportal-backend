<?php

namespace App\Backend\VideoChannel\Business\Expander\Transfer;

use App\Shared\Generated\DTO\Video\VideoChannelTransfer;

interface VideoChannelTransferExpanderInterface
{
    /**
     * @param VideoChannelTransfer $videoChannelTransfer
     *
     * @return void
     */
    public function expand(VideoChannelTransfer $videoChannelTransfer): void;
}

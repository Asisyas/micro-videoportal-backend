<?php

namespace App\Backend\Channel\VideoChannel\Business\Expander\Transfer;

interface VideoChannelTransferExpanderFactoryInterface
{
    /**
     * @return VideoChannelTransferExpanderInterface
     */
    public function create(): VideoChannelTransferExpanderInterface;
}

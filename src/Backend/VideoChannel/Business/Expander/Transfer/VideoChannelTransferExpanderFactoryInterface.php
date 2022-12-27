<?php

namespace App\Backend\VideoChannel\Business\Expander\Transfer;

interface VideoChannelTransferExpanderFactoryInterface
{
    /**
     * @return VideoChannelTransferExpanderInterface
     */
    public function create(): VideoChannelTransferExpanderInterface;
}

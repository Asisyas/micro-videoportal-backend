<?php

namespace App\Backend\Video\Business\IndexProvider\Expander;

interface VideoIndexTransferExpanderFactoryInterface
{
    /**
     * @return VideoIndexTransferExpanderInterface
     */
    public function create(): VideoIndexTransferExpanderInterface;
}
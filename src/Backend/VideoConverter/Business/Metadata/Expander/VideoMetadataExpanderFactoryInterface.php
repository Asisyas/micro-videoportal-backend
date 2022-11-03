<?php

namespace App\Backend\VideoConverter\Business\Metadata\Expander;

interface VideoMetadataExpanderFactoryInterface
{
    /**
     * @return VideoMetadataExpanderInterface
     */
    public function create(): VideoMetadataExpanderInterface;
}
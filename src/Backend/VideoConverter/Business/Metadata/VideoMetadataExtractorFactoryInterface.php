<?php

namespace App\Backend\VideoConverter\Business\Metadata;

interface VideoMetadataExtractorFactoryInterface
{
    /**
     * @return VideoMetadataExtractorInterface
     */
    public function create(): VideoMetadataExtractorInterface;
}
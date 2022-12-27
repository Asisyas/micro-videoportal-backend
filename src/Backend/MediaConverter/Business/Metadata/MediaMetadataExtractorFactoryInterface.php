<?php

namespace App\Backend\MediaConverter\Business\Metadata;

interface MediaMetadataExtractorFactoryInterface
{
    /**
     * @return MediaMetadataExtractorInterface
     */
    public function create(): MediaMetadataExtractorInterface;
}

<?php

namespace App\Backend\VideoConverter\Business\Metadata\Expander;

use App\Backend\VideoConverter\Business\Metadata\Expander\Impl\StreamAudioExpander;
use App\Backend\VideoConverter\Business\Metadata\Expander\Impl\StreamVideoExpander;

class VideoMetadataFromStreamExpanderFactory implements VideoMetadataExpanderFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): VideoMetadataExpanderInterface
    {
        return new VideoMetadataFromStreamExpander(
            new StreamVideoExpander(),
            new StreamAudioExpander()
        );
    }
}
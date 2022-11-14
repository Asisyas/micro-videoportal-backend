<?php

namespace App\Backend\MediaConverter\Business\Metadata\Expander;

use App\Backend\MediaConverter\Business\Metadata\Expander\Impl\DefaultsExpander;
use App\Backend\MediaConverter\Business\Metadata\Expander\Impl\StreamVideoExpander;

class MetadataFromStreamExpanderFactory implements MetadataExpanderFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): MetadataExpanderInterface
    {
        return new MetadataFromStreamExpander(
            new DefaultsExpander(),
            new StreamVideoExpander(),
        );
    }
}
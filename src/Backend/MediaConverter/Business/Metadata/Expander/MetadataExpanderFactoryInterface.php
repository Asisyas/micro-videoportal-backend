<?php

namespace App\Backend\MediaConverter\Business\Metadata\Expander;

interface MetadataExpanderFactoryInterface
{
    /**
     * @return MetadataExpanderInterface
     */
    public function create(): MetadataExpanderInterface;
}

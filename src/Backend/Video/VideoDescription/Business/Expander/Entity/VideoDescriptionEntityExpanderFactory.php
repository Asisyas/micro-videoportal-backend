<?php

namespace App\Backend\Video\VideoDescription\Business\Expander\Entity;

class VideoDescriptionEntityExpanderFactory implements VideoDescriptionEntityExpanderFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): VideoDescriptionEntityExpanderInterface
    {
        return new VideoDescriptionEntityExpander();
    }
}

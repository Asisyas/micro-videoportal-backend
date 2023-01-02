<?php

namespace App\Backend\Video\VideoDescription\Business\Expander\Entity;

interface VideoDescriptionEntityExpanderFactoryInterface
{
    /**
     * @return VideoDescriptionEntityExpanderInterface
     */
    public function create(): VideoDescriptionEntityExpanderInterface;
}

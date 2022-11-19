<?php

namespace App\Backend\VideoDescription\Business\Expander\Entity;

interface VideoDescriptionEntityExpanderFactoryInterface
{
    /**
     * @return VideoDescriptionEntityExpanderInterface
     */
    public function create(): VideoDescriptionEntityExpanderInterface;
}
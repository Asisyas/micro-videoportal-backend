<?php

namespace App\Backend\Video\VideoDescription\Business\Manager;

interface VideoDescriptionManagerFactoryInterface
{
    /**
     * @return VideoDescriptionManagerInterface
     */
    public function create(): VideoDescriptionManagerInterface;
}

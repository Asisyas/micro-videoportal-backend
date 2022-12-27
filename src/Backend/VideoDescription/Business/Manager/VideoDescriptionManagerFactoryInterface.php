<?php

namespace App\Backend\VideoDescription\Business\Manager;

interface VideoDescriptionManagerFactoryInterface
{
    /**
     * @return VideoDescriptionManagerInterface
     */
    public function create(): VideoDescriptionManagerInterface;
}

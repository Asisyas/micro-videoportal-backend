<?php

namespace App\Backend\Video\Business\Manager;

interface VideoManagerFactoryInterface
{
    /**
     * @return VideoManagerInterface
     */
    public function create(): VideoManagerInterface;
}

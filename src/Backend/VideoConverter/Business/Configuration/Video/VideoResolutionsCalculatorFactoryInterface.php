<?php

namespace App\Backend\VideoConverter\Business\Configuration\Video;

interface VideoResolutionsCalculatorFactoryInterface
{
    /**
     * @return VideoResolutionsCalculatorInterface
     */
    public function create(): VideoResolutionsCalculatorInterface;
}
<?php

namespace App\Backend\MediaConverter\Business\Configuration\Media;

interface MediaResolutionsCalculatorFactoryInterface
{
    /**
     * @return MediaResolutionsCalculatorInterface
     */
    public function create(): MediaResolutionsCalculatorInterface;
}

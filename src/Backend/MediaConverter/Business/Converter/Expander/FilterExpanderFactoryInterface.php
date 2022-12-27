<?php

namespace App\Backend\MediaConverter\Business\Converter\Expander;

interface FilterExpanderFactoryInterface
{
    /**
     * @return FilterExpanderInterface
     */
    public function create(): FilterExpanderInterface;
}

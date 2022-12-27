<?php

namespace App\Backend\MediaConverter\Business\Converter;

interface ConverterFactoryInterface
{
    /**
     * @return ConverterInterface
     */
    public function create(): ConverterInterface;
}

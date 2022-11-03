<?php

namespace App\Backend\VideoConverter\Business\Converter;

interface VideoConverterFactoryInterface
{
    /**
     * @return VideoConverterInterface
     */
    public function create(): VideoConverterInterface;
}
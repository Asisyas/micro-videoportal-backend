<?php

namespace App\Backend\Video\Business\Configuration\Video;

interface ConverterConfigurationGeneratorFactoryInterface
{
    /**
     * @return ConverterConfigurationGeneratorInterface
     */
    public function create(): ConverterConfigurationGeneratorInterface;
}
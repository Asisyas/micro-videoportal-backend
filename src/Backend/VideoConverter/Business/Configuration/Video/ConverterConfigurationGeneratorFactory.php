<?php

namespace App\Backend\Video\Business\Configuration\Video;

class ConverterConfigurationGeneratorFactory implements ConverterConfigurationGeneratorFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): ConverterConfigurationGeneratorInterface
    {
        return new ConverterConfigurationGenerator();
    }
}
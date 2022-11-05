<?php

namespace App\Backend\VideoConverter\Business\Configuration\Video;

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
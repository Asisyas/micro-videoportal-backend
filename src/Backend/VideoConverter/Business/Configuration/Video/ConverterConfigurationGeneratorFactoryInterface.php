<?php

namespace App\Backend\VideoConverter\Business\Configuration\Video;

interface ConverterConfigurationGeneratorFactoryInterface
{
    /**
     * @return ConverterConfigurationGeneratorInterface
     */
    public function create(): ConverterConfigurationGeneratorInterface;
}
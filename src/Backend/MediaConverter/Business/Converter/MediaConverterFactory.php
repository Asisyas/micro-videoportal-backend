<?php

namespace App\Backend\MediaConverter\Business\Converter;

use App\Backend\MediaConverter\Business\Converter\Expander\FilterExpanderFactoryInterface;
use App\Backend\MediaConverter\MediaConverterPluginConfiguration;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class MediaConverterFactory implements ConverterFactoryInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     * @param FilesystemFacadeInterface $filesystemFacade
     * @param FilterExpanderFactoryInterface $filterExpanderFactory
     * @param MediaConverterPluginConfiguration $pluginConfiguration
     */
    public function __construct(
        private readonly FfmpegFacadeInterface $ffmpegFacade,
        private readonly FilesystemFacadeInterface $filesystemFacade,
        private readonly FilterExpanderFactoryInterface $filterExpanderFactory,
        private readonly MediaConverterPluginConfiguration $pluginConfiguration
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ConverterInterface
    {
        return new MediaConverter(
            $this->ffmpegFacade,
            $this->filesystemFacade->createFsOperator(),
            $this->filterExpanderFactory->create(),
            $this->pluginConfiguration
        );
    }
}
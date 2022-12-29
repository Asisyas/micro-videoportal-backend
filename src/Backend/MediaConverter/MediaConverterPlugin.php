<?php

namespace App\Backend\MediaConverter;

use App\Backend\MediaConverter\Business\Configuration\Media\MediaResolutionsCalculatorFactory;
use App\Backend\MediaConverter\Business\Configuration\Media\MediaResolutionsCalculatorFactoryInterface;
use App\Backend\MediaConverter\Business\Converter\ConverterFactoryInterface;
use App\Backend\MediaConverter\Business\Converter\Expander\Ext\DefaultsExpander;
use App\Backend\MediaConverter\Business\Converter\Expander\Ext\DisableAudioVideoExpander;
use App\Backend\MediaConverter\Business\Converter\Expander\Ext\VideoFiltersExpander;
use App\Backend\MediaConverter\Business\Converter\Expander\Ext\VideoVerticalExpander;
use App\Backend\MediaConverter\Business\Converter\Expander\FilterExpanderFactory;
use App\Backend\MediaConverter\Business\Converter\Expander\FilterExpanderFactoryInterface;
use App\Backend\MediaConverter\Business\Converter\MediaConverterFactory;
use App\Backend\MediaConverter\Business\Dash\DashManifestGeneratorFactory;
use App\Backend\MediaConverter\Business\Dash\DashManifestGeneratorFactoryInterface;
use App\Backend\MediaConverter\Business\Metadata\Expander\MetadataExpanderFactoryInterface;
use App\Backend\MediaConverter\Business\Metadata\Expander\MetadataFromStreamExpanderFactory;
use App\Backend\MediaConverter\Business\Metadata\MediaMetadataExtractorFactory;
use App\Backend\MediaConverter\Business\Metadata\MediaMetadataExtractorFactoryInterface;
use App\Backend\MediaConverter\Facade\MediaConverterFacade;
use App\Backend\MediaConverter\Facade\MediaConverterFacadeInterface;
use App\Backend\MediaConverter\Options\Converter\Resolution;
use App\Backend\MediaConverter\Options\Converter\ResolutionVideoOptionsInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @method MediaConverterPluginConfiguration configuration()
 */
class MediaConverterPlugin extends AbstractPlugin
{
    /**
     * @var FfmpegFacadeInterface
     */
    private readonly FfmpegFacadeInterface $ffmpegFacade;

    private readonly FilesystemFacadeInterface $filesystemFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(MediaConverterFacadeInterface::class, function (
            FfmpegFacadeInterface $ffmpegFacade,
            FilesystemFacadeInterface $filesystemFacade
        ) {
            $this->ffmpegFacade = $ffmpegFacade;
            $this->filesystemFacade = $filesystemFacade;

            return $this->createFacade();
        });
    }

    protected function createVideoResolutionsCalculatorFactory(): MediaResolutionsCalculatorFactory
    {
        return new MediaResolutionsCalculatorFactory(
            ...$this->createResolutionsAvailableCollection()
        );
    }

    protected function createFacade(): MediaConverterFacade
    {
        return new MediaConverterFacade(
            $this->createVideoMetadataExtractorFactory(),
            $this->createMediaConverterFactory(),
            $this->createVideoResolutionsCalculatorFactory(),
            $this->createDashManifestGeneratorFactory()
        );
    }

    /**
     * @return Resolution[]
     *
     * @psalm-return list{0?: Resolution,...}
     */
    protected function createResolutionsAvailableCollection(): array
    {
        $result = [];

        foreach ($this->configuration()->getResolutionsList() as $res) {
            $result[] = new Resolution(
                mediaTypeFlag:  $res[6],
                height:         $res[0],
                bitRateMin:     $res[1],
                bitRateMax:     $res[2],
                frameRate:      $res[3],
                gopSize:        $res[4],
                keyIntMin:      $res[5],
            );
        }

        return $result;
    }

    protected function createVideoMetadataExtractorFactory(): MediaMetadataExtractorFactory
    {
        return new MediaMetadataExtractorFactory(
            $this->ffmpegFacade,
            $this->createVideoMetadataFromStreamExpanderFactory(),
            $this->filesystemFacade
        );
    }

    protected function createDashManifestGeneratorFactory(): DashManifestGeneratorFactory
    {
        return new DashManifestGeneratorFactory(
            $this->filesystemFacade,
            $this->ffmpegFacade
        );
    }

    protected function createMediaConverterFactory(): MediaConverterFactory
    {
        return new MediaConverterFactory(
            $this->ffmpegFacade,
            $this->filesystemFacade,
            $this->createFilterExpanderFactory(),
            $this->configuration()
        );
    }

    protected function createFilterExpanderFactory(): FilterExpanderFactory
    {
        return new FilterExpanderFactory(
            new DefaultsExpander(),
            new DisableAudioVideoExpander(),
            new VideoFiltersExpander(),
            new VideoVerticalExpander(),
        );
    }

    protected function createVideoMetadataFromStreamExpanderFactory(): MetadataFromStreamExpanderFactory
    {
        return new MetadataFromStreamExpanderFactory();
    }
}

<?php

namespace App\Backend\MediaConverter;

use App\Backend\MediaConverter\Business\Configuration\Media\MediaResolutionsCalculatorFactory;
use App\Backend\MediaConverter\Business\Configuration\Media\MediaResolutionsCalculatorFactoryInterface;
use App\Backend\MediaConverter\Business\Converter\ConverterFactoryInterface;
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
        $container->register(MediaConverterFacadeInterface::class, function(
            FfmpegFacadeInterface $ffmpegFacade,
            FilesystemFacadeInterface $filesystemFacade
        ) {
            $this->ffmpegFacade = $ffmpegFacade;
            $this->filesystemFacade = $filesystemFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return MediaResolutionsCalculatorFactoryInterface
     */
    protected function createVideoResolutionsCalculatorFactory(): MediaResolutionsCalculatorFactoryInterface
    {
        return new MediaResolutionsCalculatorFactory(
            ...$this->createResolutionsAvailableCollection()
        );
    }

    /**
     * @return MediaConverterFacadeInterface
     */
    protected function createFacade(): MediaConverterFacadeInterface
    {
        return new MediaConverterFacade(
            $this->createVideoMetadataExtractorFactory(),
            $this->createMediaConverterFactory(),
            $this->createVideoResolutionsCalculatorFactory(),
            $this->createDashManifestGeneratorFactory()
        );
    }

    /**
     * @return iterable<ResolutionVideoOptionsInterface>
     */
    protected function createResolutionsAvailableCollection(): iterable
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

    /**
     * @return MediaMetadataExtractorFactoryInterface
     */
    protected function createVideoMetadataExtractorFactory(): MediaMetadataExtractorFactoryInterface
    {
        return new MediaMetadataExtractorFactory(
            $this->ffmpegFacade,
            $this->createVideoMetadataFromStreamExpanderFactory(),
            $this->filesystemFacade
        );
    }

    /**
     * @return DashManifestGeneratorFactoryInterface
     */
    protected function createDashManifestGeneratorFactory(): DashManifestGeneratorFactoryInterface
    {
        return new DashManifestGeneratorFactory(
            $this->filesystemFacade,
            $this->ffmpegFacade
        );
    }

    /**
     * @return ConverterFactoryInterface
     */
    protected function createMediaConverterFactory(): ConverterFactoryInterface
    {
        return new MediaConverterFactory(
            $this->ffmpegFacade,
            $this->filesystemFacade,
            $this->configuration()
        );
    }

    /**
     * @return MetadataExpanderFactoryInterface
     */
    protected function createVideoMetadataFromStreamExpanderFactory(): MetadataExpanderFactoryInterface
    {
        return new MetadataFromStreamExpanderFactory();
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoConverterPluginBackend';
    }
}
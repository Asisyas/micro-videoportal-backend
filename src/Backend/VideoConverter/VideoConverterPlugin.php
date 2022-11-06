<?php

namespace App\Backend\VideoConverter;

use App\Backend\VideoConverter\Business\Configuration\Video\VideoResolutionsCalculatorFactory;
use App\Backend\VideoConverter\Business\Configuration\Video\VideoResolutionsCalculatorFactoryInterface;
use App\Backend\VideoConverter\Business\Converter\VideoConverterFactory;
use App\Backend\VideoConverter\Business\Converter\VideoConverterFactoryInterface;
use App\Backend\VideoConverter\Business\Metadata\Expander\VideoMetadataExpanderFactoryInterface;
use App\Backend\VideoConverter\Business\Metadata\Expander\VideoMetadataFromStreamExpanderFactory;
use App\Backend\VideoConverter\Business\Metadata\VideoMetadataExtractorFactory;
use App\Backend\VideoConverter\Business\Metadata\VideoMetadataExtractorFactoryInterface;
use App\Backend\VideoConverter\Facade\VideoConverterFacade;
use App\Backend\VideoConverter\Facade\VideoConverterFacadeInterface;
use App\Backend\VideoConverter\Options\Converter\Resolution;
use App\Backend\VideoConverter\Options\Converter\ResolutionVideoOptionsInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @method VideoConverterPluginConfiguration configuration()
 */
class VideoConverterPlugin extends AbstractPlugin
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
        $container->register(VideoConverterFacadeInterface::class, function(
            FfmpegFacadeInterface $ffmpegFacade,
            FilesystemFacadeInterface $filesystemFacade
        ) {
            $this->ffmpegFacade = $ffmpegFacade;
            $this->filesystemFacade = $filesystemFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoResolutionsCalculatorFactoryInterface
     */
    protected function createVideoResolutionsCalculatorFactory(): VideoResolutionsCalculatorFactoryInterface
    {
        return new VideoResolutionsCalculatorFactory(
            ...$this->createResolutionsAvailableCollection()
        );
    }

    /**
     * @return VideoConverterFacadeInterface
     */
    protected function createFacade(): VideoConverterFacadeInterface
    {
        return new VideoConverterFacade(
            $this->createVideoMetadataExtractorFactory(),
            $this->createVideoConverterFactory(),
            $this->createVideoResolutionsCalculatorFactory()
        );
    }

    /**
     * @return iterable<ResolutionVideoOptionsInterface>
     */
    protected function createResolutionsAvailableCollection(): iterable
    {
        foreach ($this->configuration()->getResolutionsList() as $res) {
            $result[] = new Resolution(
                $res[0],
                $res[1],
                $res[2]
            );
        }

        return $result;
    }

    /**
     * @return VideoMetadataExtractorFactoryInterface
     */
    protected function createVideoMetadataExtractorFactory(): VideoMetadataExtractorFactoryInterface
    {
        return new VideoMetadataExtractorFactory(
            $this->ffmpegFacade,
            $this->createVideoMetadataFromStreamExpanderFactory(),
            $this->filesystemFacade
        );
    }

    /**
     * @return VideoConverterFactoryInterface
     */
    protected function createVideoConverterFactory(): VideoConverterFactoryInterface
    {
        return new VideoConverterFactory(
            $this->ffmpegFacade,
            $this->filesystemFacade
        );
    }

    /**
     * @return VideoMetadataExpanderFactoryInterface
     */
    protected function createVideoMetadataFromStreamExpanderFactory(): VideoMetadataExpanderFactoryInterface
    {
        return new VideoMetadataFromStreamExpanderFactory();
    }

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoConverterPluginBackend';
    }
}
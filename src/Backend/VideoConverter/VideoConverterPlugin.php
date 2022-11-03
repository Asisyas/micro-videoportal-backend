<?php

namespace App\Backend\VideoConverter;

use App\Backend\VideoConverter\Business\Converter\VideoConverterFactory;
use App\Backend\VideoConverter\Business\Converter\VideoConverterFactoryInterface;
use App\Backend\VideoConverter\Business\Metadata\Expander\VideoMetadataExpanderFactoryInterface;
use App\Backend\VideoConverter\Business\Metadata\Expander\VideoMetadataFromStreamExpanderFactory;
use App\Backend\VideoConverter\Business\Metadata\VideoMetadataExtractorFactory;
use App\Backend\VideoConverter\Business\Metadata\VideoMetadataExtractorFactoryInterface;
use App\Backend\VideoConverter\Facade\VideoConverterFacade;
use App\Backend\VideoConverter\Facade\VideoConverterFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;

class VideoConverterPlugin extends AbstractPlugin
{
    /**
     * @var FfmpegFacadeInterface
     */
    private readonly FfmpegFacadeInterface $ffmpegFacade;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(VideoConverterFacadeInterface::class, function(
            FfmpegFacadeInterface $ffmpegFacade
        ) {
            $this->ffmpegFacade = $ffmpegFacade;

            return $this->createFacade();
        });
    }

    /**
     * @return VideoConverterFacadeInterface
     */
    protected function createFacade(): VideoConverterFacadeInterface
    {
        return new VideoConverterFacade(
            $this->createVideoMetadataExtractorFactory(),
            $this->createVideoConverterFactory()
        );
    }

    /**
     * @return VideoMetadataExtractorFactoryInterface
     */
    protected function createVideoMetadataExtractorFactory(): VideoMetadataExtractorFactoryInterface
    {
        return new VideoMetadataExtractorFactory(
            $this->ffmpegFacade,
            $this->createVideoMetadataFromStreamExpanderFactory()
        );
    }

    /**
     * @return VideoConverterFactoryInterface
     */
    protected function createVideoConverterFactory(): VideoConverterFactoryInterface
    {
        return new VideoConverterFactory(
            $this->ffmpegFacade
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
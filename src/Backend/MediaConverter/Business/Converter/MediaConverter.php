<?php

namespace App\Backend\MediaConverter\Business\Converter;

use App\Backend\MediaConverter\Business\Converter\Expander\FilterExpanderInterface;
use App\Backend\MediaConverter\MediaConverterPluginConfiguration;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use FFMpeg\Coordinate\FrameRate;
use FFMpeg\Filters\Audio\SimpleFilter;
use FFMpeg\Format\Video\DefaultVideo;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Media\Audio;
use FFMpeg\Media\Video;
use League\Flysystem\FilesystemOperator;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;

/**
 * TODO: PoC solution. Should be expanded as composition
 */
readonly class MediaConverter implements ConverterInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     * @param FilesystemOperator $filesystemOperator
     * @param FilterExpanderInterface $filterExpander
     * @param MediaConverterPluginConfiguration $pluginConfiguration
     */
    public function __construct(
        private FfmpegFacadeInterface             $ffmpegFacade,
        private FilesystemOperator                $filesystemOperator,
        private FilterExpanderInterface           $filterExpander,
        private MediaConverterPluginConfiguration $pluginConfiguration
    ) {
    }

    public function convert(MediaConfigurationTransfer $mediaConfigurationTransfer, callable $progressListener = null): MediaConvertedResultTransfer
    {
        $fileTransfer       = $mediaConfigurationTransfer->getFile();
        $resolutionTransfer = $mediaConfigurationTransfer->getResolutionConfiguration();
        $format             = $this->createFormat();
        $convertSource      = $this->openSourceFile($fileTransfer);
        $ffmpegFilters      = $convertSource->filters();
        $mediaSourceType    = $resolutionTransfer->getMediaTypeFlag();

        $this->addSourceFiltersDefault($convertSource, $mediaConfigurationTransfer);
        $this->updateFormatDefaults($format);

        $kbRate = $resolutionTransfer->getBitRate();
        if ($kbRate) {
            $format->setKiloBitrate($kbRate);
        }

        if ($progressListener !== null) {
            /** @psalm-suppress UnusedClosureParam */
            $format->on('progress', function ($video, $format, float $percentage) use ($progressListener) {
                $progressListener($percentage);
            });
        }

        $isVideoDisable = ($mediaSourceType & MediaConverterPluginConfiguration::FLAG_VIDEO)
            !== MediaConverterPluginConfiguration::FLAG_VIDEO;

        $isAudioDisable = ($mediaSourceType & MediaConverterPluginConfiguration::FLAG_AUDIO)
            !== MediaConverterPluginConfiguration::FLAG_AUDIO;

        if ($isAudioDisable && $isVideoDisable) {
            throw new \RuntimeException(sprintf(
                'Wrong configuration: nothing to convert. File ID "%s"',
                $fileTransfer->getId()
            ));
        }

        $pathSuffix = '';
        if (!$isAudioDisable) {
            $pathSuffix .= sprintf('_audio-%dKb', $kbRate);
        }

        if (!$isVideoDisable) {
            $pathSuffix .= sprintf(
                '_video-%dx%d-%dKb',
                $resolutionTransfer->getWidth(),
                $resolutionTransfer->getHeight(),
                $kbRate
            );
        }

        if (!$isVideoDisable && $resolutionTransfer->getFrameRate()) {
            // @phpstan-ignore-next-line
            $ffmpegFilters->framerate(
                new FrameRate($resolutionTransfer->getFrameRate()),
                $resolutionTransfer->getGop()
            );
        }

        $path = sprintf('%s.%s.webm', $fileTransfer->getId(), $pathSuffix);

        $this->save($convertSource, $format, $path);

        return (new MediaConvertedResultTransfer())
            ->setResolution($resolutionTransfer)
            ->setSrc($path);
    }

    /**
     * @param FileTransfer $fileTransfer
     *
     * @return Video|Audio
     */
    protected function openSourceFile(FileTransfer $fileTransfer): Video|Audio
    {
        return $this->ffmpegFacade
            ->open($this->filesystemOperator->publicUrl($fileTransfer->getId()));
    }

    /**
     * TODO: Create filters expander as composition
     *
     * @param Audio|Video $convertSource
     * @param MediaConfigurationTransfer $mediaConfigurationTransfer
     *
     * @return void
     */
    protected function addSourceFiltersDefault(Audio|Video $convertSource, MediaConfigurationTransfer $mediaConfigurationTransfer): void
    {
        $filters = [];
        $this->filterExpander->expand($filters, $mediaConfigurationTransfer->getResolutionConfiguration()); //@phpstan-ignore-lines

        $convertSource->addFilter(
            new SimpleFilter(
                $filters
            )
        );
    }

    /**
     * @return DefaultVideo
     */
    protected function createFormat(): DefaultVideo
    {
        return new WebM(
            $this->pluginConfiguration->getCodecAudio(),
            $this->pluginConfiguration->getCodecVideo()
        );
    }

    /**
     * @param DefaultVideo $format
     * @return void
     */
    protected function updateFormatDefaults(DefaultVideo $format): void
    {
        $initialParameters = $format->getInitialParameters() ?: [];
        array_unshift($initialParameters, '-hwaccel', $this->pluginConfiguration->getHwAcceleration());
        $format->setInitialParameters($initialParameters);
    }

    /**
     * @param Video|Audio $convertSource
     * @param DefaultVideo $format
     * @param string $path
     *
     * @return void
     *
     * @throws \League\Flysystem\FilesystemException
     */
    protected function save(Video|Audio $convertSource, DefaultVideo $format, string $path)
    {
        $tmpFileResource = tmpfile();
        if (!$tmpFileResource) {
            throw new \RuntimeException('Can not create temp file');
        }

        $tempPointer = stream_get_meta_data($tmpFileResource);
        $tempFileDest = $tempPointer['uri'];
        try {
            $convertSource->save($format, $tempFileDest);
            $this->filesystemOperator->writeStream($path, $tmpFileResource);
        } catch (\Exception $exception) {
            throw $exception;
        } finally {
            fclose($tmpFileResource);
        }
    }
}

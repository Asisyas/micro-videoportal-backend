<?php

namespace App\Backend\MediaConverter\Business\Converter;

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
class MediaConverter implements ConverterInterface
{
    /**
     * @param FfmpegFacadeInterface $ffmpegFacade
     * @param FilesystemOperator $filesystemOperator
     * @param MediaConverterPluginConfiguration $pluginConfiguration
     */
    public function __construct(
        private readonly FfmpegFacadeInterface $ffmpegFacade,
        private readonly FilesystemOperator $filesystemOperator,
        private readonly MediaConverterPluginConfiguration $pluginConfiguration
    )
    {
    }

    public function convert(MediaConfigurationTransfer $mediaConfigurationTransfer): MediaConvertedResultTransfer
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
        if($kbRate) {
            $format->setKiloBitrate($kbRate);
        }

        $isVideoDisable = ($mediaSourceType & MediaConverterPluginConfiguration::FLAG_VIDEO)
            !== MediaConverterPluginConfiguration::FLAG_VIDEO;

        $isAudioDisable = ($mediaSourceType & MediaConverterPluginConfiguration::FLAG_AUDIO)
            !== MediaConverterPluginConfiguration::FLAG_AUDIO;

        if($isAudioDisable && $isVideoDisable) {
            throw new \RuntimeException(sprintf(
                'Wrong configuration: nothing to convert. File ID "%s"', $fileTransfer->getId()
            ));
        }

        $pathSuffix = '';
        if(!$isAudioDisable) {
            $pathSuffix .= sprintf('_audio-%dKb', $kbRate);
        }

        if(!$isVideoDisable) {
            $pathSuffix .= sprintf(
                '_video-%dx%d-%dKb',
                $resolutionTransfer->getWidth(),
                $resolutionTransfer->getHeight(),
                $kbRate
            );
        }

        if(!$isVideoDisable && $resolutionTransfer->getFrameRate()) {
            $ffmpegFilters->framerate(
                new FrameRate($resolutionTransfer->getFrameRate()), $resolutionTransfer->getGop()
            );
        }

        $path = sprintf('%s%s.webm', $fileTransfer->getId(), $pathSuffix);

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
        $filters            = [ '-dash', '1' ];

        $resolutionTransfer = $mediaConfigurationTransfer->getResolutionConfiguration();
        $isVideoDisable     = ($resolutionTransfer->getMediaTypeFlag() & MediaConverterPluginConfiguration::FLAG_VIDEO) === 0;
        $isAudioDisable     = ($resolutionTransfer->getMediaTypeFlag() & MediaConverterPluginConfiguration::FLAG_AUDIO) === 0;;
        $keyIntMin          = $resolutionTransfer->getKeyintMin();

        if($isVideoDisable) {
            $filters[] = '-vn';
        } else {
            $filters[] = '-s';
            $filters[] = sprintf(
                '%dx%d',
                $resolutionTransfer->getWidth(),
                $resolutionTransfer->getHeight()
            );

            if($keyIntMin) {
                $filters[] = '-keyint_min';
                $filters[] = $resolutionTransfer->getKeyintMin();
            }
        }

        if($isAudioDisable) {
            $filters[] = '-an';
        }

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
     * @param $path
     *
     * @return void
     *
     * @throws \League\Flysystem\FilesystemException
     */
    protected function save(Video|Audio $convertSource, DefaultVideo $format, $path)
    {
        $tmpFileResource = tmpfile();
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
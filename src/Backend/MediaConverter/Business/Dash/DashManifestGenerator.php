<?php

namespace App\Backend\MediaConverter\Business\Dash;

use App\Backend\MediaConverter\MediaConverterPluginConfiguration;
use App\Shared\Generated\DTO\MediaConverter\DashManifestTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;
use League\Flysystem\FilesystemOperator;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;

class DashManifestGenerator implements DashManifestGeneratorInterface
{
    /**
     * @param FilesystemOperator $filesystemOperator
     * @param FfmpegFacadeInterface $ffmpegFacade
     */
    public function __construct(
        private readonly FilesystemOperator $filesystemOperator,
        private readonly FfmpegFacadeInterface $ffmpegFacade
    )
    {

    }

    /**
     * {@inheritDoc}
     */
    public function generate(MediaConvertedResultCollectionTransfer $convertedResultCollectionTransfer): DashManifestTransfer
    {
        $additionalParameters = ['-f', 'webm_dash_manifest'];
        $copyMaps = ['-c', 'copy'];

        /** @var MediaConvertedResultTransfer $converterResultTransfer */
        $sources = [];
        $mapCount = 0;
        $audioStreams = [];
        $videoStreams = [];
        foreach ($convertedResultCollectionTransfer->getResults() as $converterResultTransfer) {
            $fullSource = $this->filesystemOperator->publicUrl($converterResultTransfer->getSrc());
            $sources[] = $fullSource;
            $copyMaps[] = '-map';
            $copyMaps[] = $mapCount;

            $additionalParameters[] = '-i';
            $additionalParameters[] = $fullSource;
            $additionalParameters[] = '-f';
            $additionalParameters[] = 'webm_dash_manifest';

            $resolution = $converterResultTransfer->getResolution();

            if($this->isAudio($resolution)) {
                $audioStreams[] = $mapCount;
            }

            if($this->isVideo($resolution)) {
                $videoStreams[] = $mapCount;
            }

            ++$mapCount;
        }

        $copyMaps[] = '-f';
        $copyMaps[] = 'webm_dash_manifest';

        array_push($additionalParameters, ...$copyMaps);
        $additionalParameters[] = '-adaptation_sets';
        $adaptationSetString = sprintf(
            'id=0,streams=%s', implode(',', array_reverse($videoStreams))
        );

        if($audioStreams) {
            $adaptationSetString .= sprintf(' id=1,streams=%s', implode(',', $audioStreams));
        }

        $additionalParameters[] = $adaptationSetString;

        $fileId = $convertedResultCollectionTransfer->getVideoId();
        $destination = sprintf('%s.stream.mpd', $fileId);

        $this->save($additionalParameters, $destination);

        return (new DashManifestTransfer())->setSrc($destination);
    }

    /**
     * @param array $additionalParameters
     * @param string $destination
     *
     * @return void
     *
     * @throws \League\Flysystem\FilesystemException
     */
    protected function save(array $additionalParameters, string $destination)
    {
        $tmpfile = tmpfile();
        $filesource = stream_get_meta_data($tmpfile)['uri'];
        $additionalParameters[] = $filesource;
        try {
            $advancedMedia = $this->ffmpegFacade->ffmpeg()->openAdvanced([]);
            $advancedMedia->setAdditionalParameters($additionalParameters);
            $advancedMedia->save();
            $this->filesystemOperator->write($destination, file_get_contents($filesource));

        } finally {
            fclose($tmpfile);
        }

    }

    /**
     * @param MediaResolutionTransfer $resolutionTransfer
     *
     * @return bool
     */
    protected function isVideo(MediaResolutionTransfer $resolutionTransfer): bool
    {
        return $this->containsFlag($resolutionTransfer->getMediaTypeFlag(), MediaConverterPluginConfiguration::FLAG_VIDEO);
    }

    /**
     * @param MediaResolutionTransfer $resolutionTransfer
     *
     * @return bool
     */
    protected function isAudio(MediaResolutionTransfer $resolutionTransfer): bool
    {
        return $this->containsFlag($resolutionTransfer->getMediaTypeFlag(), MediaConverterPluginConfiguration::FLAG_AUDIO);
    }

    /**
     * @param int $flagSource
     * @param int $flagDest
     *
     * @return bool
     */
    protected function containsFlag(int $flagSource, int $flagDest): bool
    {
        return ($flagSource & $flagDest) === $flagDest;
    }
}
<?php

namespace App\Backend\MediaConverter\Business\Configuration\Media;

use App\Backend\MediaConverter\MediaConverterPluginConfiguration;
use App\Backend\MediaConverter\Options\Converter\ResolutionVideoOptionsInterface;
use App\Shared\Generated\DTO\MediaConverter\MediaMetadataTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;
use App\Shared\Generated\DTO\MediaConverter\StreamTransfer;

/**
 * TODO: PoC solution. Should be expanded as Composition
 */
readonly class MediaResolutionsCalculator implements MediaResolutionsCalculatorInterface
{
    /**
     * @param iterable<ResolutionVideoOptionsInterface> $options
     */
    public function __construct(private readonly iterable $options)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function calculate(MediaMetadataTransfer $metadataTransfer): MediaResolutionCollectionTransfer
    {
        $resultKeys = [];
        $result = [];
        $streamsIterator = $metadataTransfer->getStreams();
        $resultResponse = new  MediaResolutionCollectionTransfer();
        if (!$streamsIterator) {
            return $resultResponse;
        }

        /** @var StreamTransfer $streamMetadata */
        $heightMeasure = null;
        foreach ($streamsIterator as $streamMetadata) {
            $heightOriginal     = $streamMetadata->getHeight();
            $frameRateOriginal  = $streamMetadata->getFrameRate();
            $widthOriginal      = $streamMetadata->getWidth();
            $bitRateOriginal    = $streamMetadata->getBitRate();

            foreach ($this->options as $option) {
                if (($option->getMediaTypeFlag() & $streamMetadata->getMediaTypeFlag()) !== $option->getMediaTypeFlag()) {
                    continue;
                }


                if ($option->getHeight() > $heightOriginal && $heightOriginal !== null) {
                    continue;
                }

                if ($heightOriginal) {
                }

                $tmpBitRateMin = $option->getBitRateMin();
                $tmpBitRateMax = $option->getBitRateMax();
                $tmpFrameRate = $option->getFrameRate();

                if ($bitRateOriginal < $tmpBitRateMin) {
                    $tmpBitRateMin = $bitRateOriginal;
                }

                if ($bitRateOriginal < $tmpBitRateMax) {
                    $tmpBitRateMax = $bitRateOriginal;
                }

                if ($frameRateOriginal < $tmpFrameRate) {
                    $tmpFrameRate = $frameRateOriginal;
                }

                $resultKey = sprintf(
                    '%d-%d-%d',
                    $option->getHeight() ?: 0,
                    $widthOriginal ?: 0,
                    $tmpFrameRate ?: $tmpBitRateMax ?: $tmpBitRateMin
                );

                if (in_array($resultKey, $resultKeys)) {
                    continue;
                }

                $resultKeys[] = $resultKey;

                $mediaResolutionTransfer = (new MediaResolutionTransfer())
                    ->setBitRate($tmpBitRateMax ?: $tmpBitRateMin)
                    ->setMediaTypeFlag($option->getMediaTypeFlag())
                ;

                if (
                    ($streamMetadata->getMediaTypeFlag() & MediaConverterPluginConfiguration::FLAG_VIDEO) ===
                    MediaConverterPluginConfiguration::FLAG_VIDEO) {
                    $mediaResolutionTransfer
                        ->setHeight($option->getHeight())
                        ->setWidth($option->getHeight() / $heightMeasure) // @phpstan-ignore-line
                        ->setFrameRate($tmpFrameRate)
                        ->setGop($option->getGopSize())
                        ->setKeyintMin($option->getKeyIntMin())
                    ;
                }

                $mediaResolutionTransfer->setRotation($streamMetadata->getRotation());

                $result[] = $mediaResolutionTransfer;
            }
        }
        usort(
            $result,
            fn (MediaResolutionTransfer $left, MediaResolutionTransfer $right): bool => //@phpstan-ignore-line
                $left->getMediaTypeFlag() > $right->getMediaTypeFlag()
        );

        return $resultResponse->setResolutions($result);
    }
}

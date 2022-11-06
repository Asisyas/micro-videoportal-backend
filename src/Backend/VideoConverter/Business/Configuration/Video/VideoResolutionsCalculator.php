<?php

namespace App\Backend\VideoConverter\Business\Configuration\Video;

use App\Backend\VideoConverter\Options\Converter\ResolutionVideoOptionsInterface;
use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\VideoConverter\ResolutionCollectionTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;

class VideoResolutionsCalculator implements VideoResolutionsCalculatorInterface
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
    public function calculate(VideoMetadataTransfer $metadataTransfer): ResolutionCollectionTransfer
    {
        $videoStreamMetadata = $metadataTransfer->getStreamVideo();
        $heightOriginal = $videoStreamMetadata->getHeight();
        $widthOriginal = $videoStreamMetadata->getWidth();
        $bitRateOriginal = $videoStreamMetadata->getBitRate() / 1000;

        $heightMeasure =  $heightOriginal / $widthOriginal;

        $result = [];

        foreach ($this->options as $option) {
            if($option->getHeight() > $heightOriginal) {
                continue;
            }

            $bitRateExcepted = $option->getBitRate();
            if($bitRateExcepted > $bitRateOriginal) {
                $bitRateExcepted = $bitRateOriginal;
            }

            $result[] = (new ResolutionTransfer())
                ->setHeight($option->getHeight())
                ->setWidth($option->getHeight() / $heightMeasure)
                ->setBitRate($bitRateExcepted)
                ->setFrameRate($option->getFrameRate())
                ->setFps(30)
            ;
        }

        return (new  ResolutionCollectionTransfer())
            ->setResolutions($result);
    }
}
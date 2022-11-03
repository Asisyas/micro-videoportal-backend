<?php

namespace App\Backend\Video\Business\Configuration\Video;

use App\Backend\VideoConverter\Options\Converter\ResolutionVideoOptionsInterface;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertCollectionTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertResultTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoMetadataTransfer;

class ConverterConfigurationGenerator implements ConverterConfigurationGeneratorInterface
{
    /**
     * @var ResolutionVideoOptionsInterface[]
     */
    private iterable $options;

    public function __construct(ResolutionVideoOptionsInterface ...$options)
    {
        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function generate(VideoMetadataTransfer $metadataTransfer): VideoConvertCollectionTransfer
    {
        $videoStreamMetadata = $metadataTransfer->getStreamVideo();
        $originalHeight = $videoStreamMetadata->getHeight();
        $result = [];

        foreach ($this->options as $option) {
            if($option->getHeight() > $originalHeight) {
                continue;
            }

            $result[] = (new VideoConvertTransfer())
                ->setFile;
        }

        return (new VideoConvertCollectionTransfer())->setItems($result);
    }
}
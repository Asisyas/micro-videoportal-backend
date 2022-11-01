<?php

namespace App\Backend\VideoConverterConfiguration\Facade;

use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\VideoConfiguration\FfmpegResolutionConfigurationTransfer;

class VideoConverterConfigurationFacade implements VideoConverterConfigurationFacadeInterface
{
    /**
     * {@inheritDoc}
     */
    public function lookupConfigurationByResolution(ResolutionTransfer $resolutionTransfer): FfmpegResolutionConfigurationTransfer
    {
        // TODO: Implement lookupConfigurationByResolution() method.
    }
}
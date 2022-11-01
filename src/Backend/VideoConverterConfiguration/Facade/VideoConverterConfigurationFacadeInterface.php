<?php

namespace App\Backend\VideoConverterConfiguration\Facade;

use App\Shared\Generated\DTO\Video\ResolutionTransfer;
use App\Shared\Generated\DTO\VideoConfiguration\FfmpegResolutionConfigurationTransfer;

interface VideoConverterConfigurationFacadeInterface
{
    /**
     * @param ResolutionTransfer $resolutionTransfer
     *
     * @return mixed
     */
    public function lookupConfigurationByResolution(ResolutionTransfer $resolutionTransfer): FfmpegResolutionConfigurationTransfer;
}
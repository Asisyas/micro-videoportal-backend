<?php

namespace App\Backend\MediaConverter\Business\Converter\Expander\Ext;

use App\Backend\MediaConverter\Business\Converter\Expander\FilterExpanderInterface;
use App\Backend\MediaConverter\MediaConverterPluginConfiguration;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;

class DisableAudioVideoExpander implements FilterExpanderInterface
{
    /**
     * {@inheritDoc}
     */
    public function expand(array &$filters, MediaResolutionTransfer $resolutionTransfer): void
    {
        $mediaTypeFlag      = $resolutionTransfer->getMediaTypeFlag();
        $isVideoDisable     = ($mediaTypeFlag & MediaConverterPluginConfiguration::FLAG_VIDEO) === 0;
        $isAudioDisable     = ($mediaTypeFlag & MediaConverterPluginConfiguration::FLAG_AUDIO) === 0;

        if ($isVideoDisable) {
            $filters[] = '-vn';
        }

        if ($isAudioDisable) {
            $filters[] = '-an';
        }
    }
}

<?php

namespace App\Backend\MediaConverter\Business\Converter\Expander\Ext;

use App\Backend\MediaConverter\Business\Converter\Expander\FilterExpanderInterface;
use App\Backend\MediaConverter\MediaConverterPluginConfiguration;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;

class VideoFiltersExpander implements FilterExpanderInterface
{
    /**
     * TODO: Make configurable
     *
     * {@inheritDoc}
     */
    public function expand(array &$filters, MediaResolutionTransfer $resolutionTransfer): void
    {
        $isVideoDisable     = ($resolutionTransfer->getMediaTypeFlag() & MediaConverterPluginConfiguration::FLAG_VIDEO) === 0;
        if ($isVideoDisable) {
            return;
        }
        $keyIntMin          = $resolutionTransfer->getKeyintMin();

        $filters[] = '-s';
        $filters[] = sprintf(
            '%dx%d',
            $resolutionTransfer->getWidth(),
            $resolutionTransfer->getHeight()
        );

        if ($keyIntMin) {
            $filters[] = '-keyint_min';
            $filters[] = $resolutionTransfer->getKeyintMin();
        }

        $filters[] = '-tile-columns';
        $filters[] = '4';

        $filters[] = '-frame-parallel';
        $filters[] = '1';

        $filters[] = '-deadline';
        $filters[] = 'good';

        $filters[] = '-crf';
        $filters[] = '18';

        $filters[] = '-pix_fmt';
        $filters[] = 'yuv420p';

        $filters[] = '-row-mt';
        $filters[] = '1';
    }
}

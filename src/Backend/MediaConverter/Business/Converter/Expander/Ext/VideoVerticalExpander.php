<?php

namespace App\Backend\MediaConverter\Business\Converter\Expander\Ext;

use App\Backend\MediaConverter\Business\Converter\Expander\FilterExpanderInterface;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;

class VideoVerticalExpander implements FilterExpanderInterface
{

    /**
     * {@inheritDoc}
     */
    public function expand(array &$filters, MediaResolutionTransfer $resolutionTransfer): void
    {
        $rotation = $resolutionTransfer->getRotation();

        if(!$rotation) {
            return;
        }

        $filters[] = '-lavfi';
        $filters[] = '[0:v] scale=ih*16/9:-1, boxblur=luma_radius=min(h\,w)/20:luma_power=1:chroma_radius=min(cw\,ch)/20:chroma_power=1[bg];  [bg][0:v]overlay=(W-w)/2:(H-h)/2, crop=h=iw*9/16';
    }
}
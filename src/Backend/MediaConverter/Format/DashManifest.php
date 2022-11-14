<?php

namespace App\Backend\MediaConverter\Format;

use FFMpeg\Format\Video\DefaultVideo;

class DashManifest extends DefaultVideo
{
    /**
     * {@inheritDoc}
     */
    public function getAvailableAudioCodecs(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function getExtraParams(): array
    {
        return ['-f', 'webm_dash_manifest'];
    }

    /**
     * {@inheritDoc}
     */
    public function supportBFrames(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableVideoCodecs(): array
    {
        return [];
    }
}
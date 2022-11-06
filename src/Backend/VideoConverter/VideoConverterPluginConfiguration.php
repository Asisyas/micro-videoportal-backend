<?php

namespace App\Backend\VideoConverter;

use Micro\Framework\Kernel\Configuration\PluginConfiguration;

class VideoConverterPluginConfiguration extends PluginConfiguration
{
    /**
     * Height, width, bit rate, frame rate
     *
     * @return int[][]
     */
    public function getResolutionsList(): array
    {
        return [
            [ 240,  65, 24],
            [ 480,  65, 24],
            [ 720,  65,  30],
            [ 1080, 100, 30],
            [ 1440, 200, 30],
            [ 2160, 600, 30],
        ];
    }
}
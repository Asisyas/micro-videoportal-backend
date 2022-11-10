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
            [ 360,  100, 24],
            [ 480,  350, 24],
            [ 720,  500,  30],
            [ 1080, 800, 30],
            [ 1440, 1600, 30],
            [ 2160, 3500, 30],
        ];
    }
}
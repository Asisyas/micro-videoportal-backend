<?php

namespace App\Frontend\Video;

use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class VideoPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'VideoPluginFrontend';
    }
}
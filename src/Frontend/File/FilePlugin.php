<?php

namespace App\Frontend\File;

use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class FilePlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'FilePluginFrontend';
    }
}
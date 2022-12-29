<?php

namespace App\Backend\File\Configuration;

interface FilePluginConfigurationInterface
{
    /**
     * @return int
     */
    public function getChunkSizeMax(): int;
}

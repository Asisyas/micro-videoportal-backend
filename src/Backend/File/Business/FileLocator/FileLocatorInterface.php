<?php

namespace App\Backend\File\Business\FileLocator;

interface FileLocatorInterface
{
    public function lookup(string $channelId);
}
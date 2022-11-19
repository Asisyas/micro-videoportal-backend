<?php

namespace App\Client\Video\Publisher;

use App\Shared\Generated\DTO\File\FileGetTransfer;

interface VideoPublisherInterface
{
    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return void
     */
    public function publish(FileGetTransfer $fileGetTransfer): void;
}
<?php

namespace App\Shared\Saga\VideoPublish;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use Temporal\Activity\ActivityInterface;
use Micro\Plugin\Temporal\Activity\ActivityInterface as MicroActivityInterface;

#[ActivityInterface]
interface VideoPublishActivityInterface extends MicroActivityInterface
{
    /**
     * @param FileGetTransfer $fileGetTransfer
     *
     * @return FileTransfer
     */
    public function lookupSourceFile(FileGetTransfer $fileGetTransfer): FileTransfer;

    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return bool
     */
    public function propagateVideo(VideoGetTransfer $videoGetTransfer): bool;
}

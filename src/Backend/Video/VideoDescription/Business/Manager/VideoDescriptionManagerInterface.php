<?php

namespace App\Backend\Video\VideoDescription\Business\Manager;

use App\Shared\Generated\DTO\Video\VideoDescriptionDeleteTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionGetTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;

interface VideoDescriptionManagerInterface
{
    /**
     * @param VideoDescriptionGetTransfer $videoDescriptionGetTransfer
     *
     * @return VideoDescriptionTransfer
     */
    public function lookup(VideoDescriptionGetTransfer $videoDescriptionGetTransfer): VideoDescriptionTransfer;

    /**
     * @param VideoDescriptionPutTransfer $videoDescriptionPutTransfer
     *
     * @return bool
     */
    public function update(VideoDescriptionPutTransfer $videoDescriptionPutTransfer): bool;

    /**
     * @param VideoDescriptionPutTransfer $videoDescriptionPutTransfer
     *
     * @return bool
     */
    public function create(VideoDescriptionPutTransfer $videoDescriptionPutTransfer): bool;

    /**
     * @param VideoDescriptionDeleteTransfer $videoDescriptionDeleteTransfer
     *
     * @return bool
     */
    public function delete(VideoDescriptionDeleteTransfer $videoDescriptionDeleteTransfer): bool;

    /**
     * @param VideoGetTransfer $videoGetTransfer
     *
     * @return void
     */
    public function propagate(VideoGetTransfer $videoGetTransfer): void;
}

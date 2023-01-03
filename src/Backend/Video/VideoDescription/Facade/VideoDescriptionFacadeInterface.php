<?php

namespace App\Backend\Video\VideoDescription\Facade;

use App\Shared\Generated\DTO\Video\VideoDescriptionDeleteTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionGetTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;

interface VideoDescriptionFacadeInterface
{
    /**
     * @param VideoDescriptionGetTransfer $descriptionGetTransfer
     *
     * @return VideoDescriptionTransfer
     */
    public function lookup(VideoDescriptionGetTransfer $descriptionGetTransfer): VideoDescriptionTransfer;

    /**
     * @param VideoDescriptionPutTransfer $descriptionPutTransfer
     *
     * @return bool
     */
    public function update(VideoDescriptionPutTransfer $descriptionPutTransfer): bool;

    /**
     * @param VideoDescriptionPutTransfer $descriptionPutTransfer
     *
     * @return bool
     */
    public function create(VideoDescriptionPutTransfer $descriptionPutTransfer): bool;

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

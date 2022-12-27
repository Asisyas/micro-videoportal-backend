<?php

namespace App\Backend\VideoDescription\Facade;

use App\Shared\Generated\DTO\Video\VideoDescriptionDeleteTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionGetTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;

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
}

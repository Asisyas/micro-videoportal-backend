<?php

namespace App\Backend\VideoDescription\Facade;

use App\Shared\Generated\DTO\Video\VideoDescriptionDeleteTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;

interface VideoDescriptionFacadeInterface
{
    /**
     * @param VideoDescriptionTransfer $videoDescriptionTransfer
     *
     * @return bool
     */
    public function update(VideoDescriptionTransfer $videoDescriptionTransfer): bool;

    /**
     * @param VideoDescriptionTransfer $videoDescriptionTransfer
     *
     * @return bool
     */
    public function create(VideoDescriptionTransfer $videoDescriptionTransfer): bool;

    /**
     * @param VideoDescriptionDeleteTransfer $videoDescriptionDeleteTransfer
     *
     * @return bool
     */
    public function delete(VideoDescriptionDeleteTransfer $videoDescriptionDeleteTransfer): bool;
}
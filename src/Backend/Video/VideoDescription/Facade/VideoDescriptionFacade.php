<?php

namespace App\Backend\Video\VideoDescription\Facade;

use App\Backend\Video\VideoDescription\Business\Manager\VideoDescriptionManagerFactoryInterface;
use App\Shared\Generated\DTO\Video\VideoDescriptionDeleteTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionGetTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionPutTransfer;
use App\Shared\Generated\DTO\Video\VideoDescriptionTransfer;

class VideoDescriptionFacade implements VideoDescriptionFacadeInterface
{
    /**
     * @param VideoDescriptionManagerFactoryInterface $videoDescriptionManagerFactory
     */
    public function __construct(
        private readonly VideoDescriptionManagerFactoryInterface $videoDescriptionManagerFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function update(VideoDescriptionPutTransfer $descriptionPutTransfer): bool
    {
        return $this->videoDescriptionManagerFactory
            ->create()
            ->update($descriptionPutTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function create(VideoDescriptionPutTransfer $descriptionPutTransfer): bool
    {
        return $this->videoDescriptionManagerFactory
            ->create()
            ->create($descriptionPutTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(VideoDescriptionDeleteTransfer $videoDescriptionDeleteTransfer): bool
    {
        return $this->videoDescriptionManagerFactory
            ->create()
            ->delete($videoDescriptionDeleteTransfer);
    }

    /**
     * {@inheritDoc}
     */
    public function lookup(VideoDescriptionGetTransfer $descriptionGetTransfer): VideoDescriptionTransfer
    {
        return $this->videoDescriptionManagerFactory
            ->create()
            ->lookup($descriptionGetTransfer);
    }
}

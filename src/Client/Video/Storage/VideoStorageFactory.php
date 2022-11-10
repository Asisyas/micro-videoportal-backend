<?php

namespace App\Client\Video\Storage;

use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;

class VideoStorageFactory implements VideoStorageFactoryInterface
{
    /**
     * @param TemporalFacadeInterface $temporalFacade
     */
    public function __construct(
        private readonly TemporalFacadeInterface $temporalFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): VideoStorageInterface
    {
        return new VideoStorage($this->temporalFacade);
    }
}
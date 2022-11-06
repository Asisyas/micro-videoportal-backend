<?php

namespace App\Backend\VideoConverter\Options\Converter;

class Resolution implements ResolutionVideoOptionsInterface
{
    /**
     * @param int $height
     * @param int $bitRate
     * @param int $frameRate
     */
    public function __construct(
        private readonly int $height,
        private readonly int $bitRate,
        private readonly int $frameRate
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * {@inheritDoc}
     */
    public function getBitRate(): int
    {
        return $this->bitRate;
    }

    /**
     * {@inheritDoc}
     */
    public function getFrameRate(): int
    {
        return $this->frameRate;
    }
}
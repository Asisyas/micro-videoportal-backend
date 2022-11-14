<?php

namespace App\Backend\MediaConverter\Options\Converter;

class Resolution implements ResolutionVideoOptionsInterface
{
    /**
     * @param int|null $height
     * @param int|null $bitRateMin
     * @param int|null $bitRateMax
     * @param int|null $frameRate
     * @param int|null $keyIntMin
     * @param int|null $gopSize
     * @param int $mediaTypeFlag
     */
    public function __construct(
        private readonly int $mediaTypeFlag,
        private readonly int|null $height,
        private readonly int|null $bitRateMin,
        private readonly int|null $bitRateMax,
        private readonly int|null $frameRate,
        private readonly int|null $gopSize,
        private readonly int|null $keyIntMin,
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getGopSize(): int|null
    {
        return $this->gopSize;
    }

    /**
     * {@inheritDoc}
     */
    public function getKeyIntMin(): int|null
    {
        return $this->keyIntMin;
    }

    /**
     * {@inheritDoc}
     */
    public function getBitRateMin(): int|null
    {
        return $this->bitRateMin;
    }

    /**
     * {@inheritDoc}
     */
    public function getBitRateMax(): int|null
    {
        return $this->bitRateMax;
    }

    /**
     * {@inheritDoc}
     */
    public function getMediaTypeFlag(): int
    {
        return $this->mediaTypeFlag;
    }

    /**
     * {@inheritDoc}
     */
    public function getHeight(): int|null
    {
        return $this->height;
    }

    /**
     * {@inheritDoc}
     */
    public function getFrameRate(): int|null
    {
        return $this->frameRate;
    }
}
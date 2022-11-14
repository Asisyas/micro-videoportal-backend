<?php

namespace App\Backend\MediaConverter\Options\Converter;

interface ResolutionVideoOptionsInterface
{
    /**
     * @return int|null
     */
    public function getGopSize(): int|null;

    /**
     * @return int|null
     */
    public function getKeyIntMin(): int|null;

    /**
     * @return int|null
     */
    public function getBitRateMin(): int|null;

    /**
     * @return int|null
     */
    public function getBitRateMax(): int|null;

    /**
     * @return int
     */
    public function getMediaTypeFlag(): int;

    /**
     * @return int|null
     */
    public function getHeight(): int|null;

    /**
     * @return int|null
     */
    public function getFrameRate(): int|null;
}
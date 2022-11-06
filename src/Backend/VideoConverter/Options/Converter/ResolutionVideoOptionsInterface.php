<?php

namespace App\Backend\VideoConverter\Options\Converter;

interface ResolutionVideoOptionsInterface
{
    /**
     * @return int
     */
    public function getHeight(): int;

    /**
     * @return int
     */
    public function getBitRate(): int;

    /**
     * @return int
     */
    public function getFrameRate(): int;
}
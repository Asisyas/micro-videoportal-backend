<?php

namespace App\Backend\VideoConverter\Options\Converter;

interface ResolutionVideoOptionsInterface
{
    public function getHeight(): int;

    public function getWidth(): int;

    public function supports();
}
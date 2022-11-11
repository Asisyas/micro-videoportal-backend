<?php

namespace App\Shared\VideoConverter;

interface Configuration
{
    public const STATUS_PENDING = 0x0;
    public const STATUS_IS_PROGRESS = 0x1;
    public const STATUS_CONVERT_IN_PROGRESS = 0x2;
    public const STATUS_CONVERT_SUCCESS = 0x4;
    public const STATUS_FAIL = 0x8;
}
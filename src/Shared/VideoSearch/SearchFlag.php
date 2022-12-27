<?php

namespace App\Shared\VideoSearch;

interface SearchFlag
{
    public const FLAG_SEARCH_TYPE_SIMPLE = 0x100;
    // RESERVED 0x1, 0x2, 0x4, 0x8, 0x10, 0x20, 0x40, 0x80
    public const FLAG_IDX_VIDEO = 0x1;
}

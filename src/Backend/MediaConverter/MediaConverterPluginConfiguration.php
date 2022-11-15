<?php

namespace App\Backend\MediaConverter;

use Micro\Framework\Kernel\Configuration\PluginConfiguration;

class MediaConverterPluginConfiguration extends PluginConfiguration
{

    const FLAG_AUDIO    = 0x1;
    const FLAG_VIDEO    = 0x2;
    const FLAG_HDR      = self::FLAG_VIDEO | 0x4;

    /**
     * Height, width, bit rate, frame rate
     *
     * @return int[][]
     */
    public function getResolutionsList(): array
    {
        return [
            // height,  kbps-min,   kbps-max,   frame-max,  GOP     key_int_min     flag
            [   144,    300,        300,       24,         150,    150,            self::FLAG_VIDEO  ],

            [   240,    300,        300,       30,         150,    150,            self::FLAG_HDR    ],
            [   240,    500,        500,       60,         150,    150,            self::FLAG_HDR    ],
            [   240,    500,        500,        30,         150,    150,            self::FLAG_VIDEO  ],
            [   240,    800,        800,        60,         150,    150,            self::FLAG_VIDEO  ],

            [   360,    null,       null,       30,         150,    150,            self::FLAG_HDR    ],
            [   360,    null,       null,       60,         150,    150,            self::FLAG_HDR    ],
            [   360,    1000,       1000,       30,         150,    150,            self::FLAG_VIDEO  ],
            [   360,    1500,       1500,       60,         150,    150,            self::FLAG_VIDEO  ],

            [   480,    null,       null,       30,         150,    150,            self::FLAG_HDR    ],
            [   480,    null,       null,       60,         150,    150,            self::FLAG_HDR    ],
            [   480,    2500,       2500,       30,         150,    150,            self::FLAG_VIDEO  ],
            [   480,    4000,       4000,       60,         150,    150,            self::FLAG_VIDEO  ],

            [   720,    6500,       6500,       30,         150,    150,            self::FLAG_HDR    ],
            [   720,    9500,       9500,       60,         150,    150,            self::FLAG_HDR    ],
            [   720,    5000,       6500,       30,         150,    150,            self::FLAG_VIDEO  ],
            [   720,    7500,       7500,       60,         150,    150,            self::FLAG_VIDEO  ],

            [   1080,   10000,      10000,      30,         150,    150,            self::FLAG_HDR    ],
            [   1080,   15000,      15000,      60,         150,    150,            self::FLAG_HDR    ],
            [   1080,   8000,       8000,       30,         150,    150,            self::FLAG_VIDEO  ],
            [   1080,   12000,      12000,      60,         150,    150,            self::FLAG_VIDEO  ],

            [   1440,   20000,      20000,      30,         150,    150,            self::FLAG_HDR    ],
            [   1440,   30000,      30000,      60,         150,    150,            self::FLAG_HDR    ],
            [   1440,   16000,      16000,      30,         150,    150,            self::FLAG_VIDEO  ],
            [   1440,   24000,      24000,      60,         150,    150,            self::FLAG_VIDEO  ],

            [   null,   1,          128,        null,       null,   null,           self::FLAG_AUDIO  ],
        ];
    }

    /**
     * @return string
     */
    public function getCodecAudio(): string
    {
        return 'libvorbis';
    }

    /**
     * @return string
     */
    public function getCodecVideo(): string
    {
        return 'libvpx-vp9';
    }

    /**
     * @return string
     */
    public function getHwAcceleration(): string
    {
        return 'auto';
    }
}
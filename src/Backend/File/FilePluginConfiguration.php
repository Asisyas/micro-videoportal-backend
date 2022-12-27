<?php

namespace App\Backend\File;

use App\Backend\File\Configuration\FilePluginConfigurationInterface;
use Micro\Framework\Kernel\Configuration\PluginConfiguration;

class FilePluginConfiguration extends PluginConfiguration implements FilePluginConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getChunkSizeMax(): int
    {
        return $this->convertPHPSizeToBytes(ini_get('upload_max_filesize') ?: '-1');
    }

    /**
     * @param string $configRawValue
     *
     * @return int
     */
    protected function convertPHPSizeToBytes(string $configRawValue): int
    {
        $sSuffix = strtoupper(substr($configRawValue, -1));
        if (!in_array($sSuffix, array('P','T','G','M','K'))) {
            return (int)$configRawValue;
        }
        $iValue = (int) substr($configRawValue, 0, -1);
        switch ($sSuffix) {
            case 'P':
                $iValue *= 1024;
                // no break
            case 'T':
                $iValue *= 1024;
                // no break
            case 'G':
                $iValue *= 1024;
                // no break
            case 'M':
                $iValue *= 1024;
                // no break
            case 'K':
                $iValue *= 1024;
                break;
        }

        return (int)$iValue;
    }
}

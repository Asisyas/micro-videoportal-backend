<?php

namespace App\Frontend\Security;

use App\Frontend\Security\Configuration\SecurityPluginConfigurationInterface;
use Micro\Framework\Kernel\Configuration\PluginConfiguration;

class SecurityPluginConfiguration extends PluginConfiguration implements SecurityPluginConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAuthHeaderName(): string
    {
        return self::HEADER_NAME_DEFAULT;
    }
}
<?php

namespace App\Frontend\Security\Configuration;

interface SecurityPluginConfigurationInterface
{
    public const HEADER_NAME_DEFAULT = 'Authorization';

    /**
     * @return string
     */
    public function getAuthHeaderName(): string;
}

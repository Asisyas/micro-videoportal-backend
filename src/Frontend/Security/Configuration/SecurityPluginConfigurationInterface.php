<?php

namespace App\Frontend\Security\Configuration;

interface SecurityPluginConfigurationInterface
{
    const HEADER_NAME_DEFAULT = 'X-Auth-Token';

    /**
     * @return string
     */
    public function getAuthHeaderName(): string;
}
<?php

namespace App\Config;

use Dotenv\Dotenv;
use Micro\Framework\Kernel\Configuration\DefaultApplicationConfiguration;

class DotEnvConfiguration extends DefaultApplicationConfiguration
{
    private Dotenv $dotenv;

    /**
     * @param string $configFilePath
     */
    public function __construct(string $configFilePath)
    {
        $this->dotenv = Dotenv::createMutable($configFilePath);
        $this->dotenv->load();

        parent::__construct($_ENV);
    }
}

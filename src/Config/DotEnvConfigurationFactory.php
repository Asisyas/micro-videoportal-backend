<?php

namespace App\Config;

use Micro\Framework\Kernel\Configuration\ApplicationConfigurationInterface;
use Micro\Framework\Kernel\Configuration\DefaultApplicationConfigurationFactory;

class DotEnvConfigurationFactory extends DefaultApplicationConfigurationFactory
{
    /**
     * @param $fileConfig
     */
    public function __construct(private $fileConfig = __DIR__ . '/../../../etc/')
    {
        parent::__construct([]);
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ApplicationConfigurationInterface
    {
        return new DotEnvConfiguration(realpath($this->fileConfig));
    }

    /**
     * {@inheritDoc}
     */
    protected function getValue(string $key, mixed $default): mixed
    {
        return getenv($key, $default);
    }
}

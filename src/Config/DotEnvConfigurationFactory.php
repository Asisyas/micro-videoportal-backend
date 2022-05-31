<?php

namespace App\Config;

use Micro\Framework\Kernel\Configuration\ApplicationConfigurationInterface;
use Micro\Framework\Kernel\Configuration\DefaultApplicationConfigurationFactory;

class DotEnvConfigurationFactory extends DefaultApplicationConfigurationFactory
{
    /**
     * @param string $basePath
     * @param string $fileConfig
     */
    public function __construct(
        private readonly string $basePath,
        private readonly string $fileConfig = __DIR__ . '/../../../etc/'
    )
    {
        parent::__construct([]);
    }

    /**
     * {@inheritDoc}
     */
    public function create(): ApplicationConfigurationInterface
    {
        return new DotEnvConfiguration(realpath($this->basePath . DIRECTORY_SEPARATOR . $this->fileConfig), $this->basePath);
    }

    /**
     * {@inheritDoc}
     */
    protected function getValue(string $key, mixed $default): mixed
    {
        return getenv($key, $default);
    }
}

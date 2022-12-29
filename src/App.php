<?php

declare(strict_types=1);

error_reporting(E_ERROR | E_PARSE);

use Micro\Kernel\App\AppKernel;
use Micro\Framework\Kernel\Configuration\ApplicationConfigurationInterface;
use Micro\Framework\Kernel\Configuration\DefaultApplicationConfiguration;
use Dotenv\Dotenv;

$basedir = realpath(__DIR__ . '/../');
if (!$basedir) {
    throw new \RuntimeException('Can not resolve base path for application.');
}

require_once $basedir . '/vendor/autoload.php';

return function () use ($basedir): AppKernel {
    $applicationConfiguration = new class ($basedir) extends DefaultApplicationConfiguration {
        private readonly Dotenv $dotenv;

        public function __construct(string $basePath)
        {
            $_ENV['BASE_PATH'] =  $basePath;
            putenv('BASE_PATH=' . $basePath);

            $env = getenv('APP_ENV') ?: 'dev';

            $envFileCompiled = $basePath . '/' .  '.env.' .$env . '.php';
            if (file_exists($envFileCompiled)) {
                $content = include $envFileCompiled;

                parent::__construct($content);

                return;
            }

            $names[] = '.env';
            $names[] = '.env.' . $env;
            // @codingStandardsIgnoreStart
            $this->dotenv = Dotenv::createMutable($basePath, $names, false);
            $configCompiled = $this->dotenv->load();
            if($env === 'prod') {
                file_put_contents($envFileCompiled, '<?php return '. var_export($configCompiled) . ';');
            }

            // @codingStandardsIgnoreEnd
            parent::__construct($_ENV);
        }
    };

    return new AppKernel(
        $applicationConfiguration,
        include_once $basedir . '/etc/plugins.php',
        $applicationConfiguration->get('APP_ENV', 'dev')
    );
};

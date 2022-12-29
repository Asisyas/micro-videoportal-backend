<?php

declare(strict_types=1);

/**
 * This file is part of the Micro framework package.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Shared\Config\Command;

use Micro\Framework\Kernel\KernelInterface;
use Micro\Kernel\App\AppKernelInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class ConfigDumpCommand extends Command
{
    public function __construct(
        private readonly AppKernelInterface $kernel
    ) {
        parent::__construct('app:config:dump');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        file_put_contents(getenv('BASE_PATH') . DIRECTORY_SEPARATOR .  '.env.' . $this->kernel->environment() . '.php', '<?php return '. var_export($_ENV, true) . ';');

        return self::SUCCESS;
    }
}

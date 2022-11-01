<?php

namespace App\Backend\Test\Command;

use Micro\Plugin\Locator\Facade\LocatorFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClassLocatorCommand extends Command
{
    public function __construct(private readonly LocatorFacadeInterface $locatorFacade)
    {
        parent::__construct('test:class:locate');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $iterator = $this->locatorFacade->lookup(Command::class);

        foreach ($iterator as $closure) {
            dump($closure);
        }

        return self::SUCCESS;
    }
}
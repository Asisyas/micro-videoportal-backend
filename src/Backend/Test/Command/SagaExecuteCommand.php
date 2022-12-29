<?php

namespace App\Backend\Test\Command;

use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SagaExecuteCommand extends Command
{
    public function __construct(
        private readonly TemporalFacadeInterface $temporalFacade
    ) {
        parent::__construct('test:saga:execute');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $wf = $this->temporalFacade
            ->createWorker();

        $wf->run();

        return self::SUCCESS;
    }
}

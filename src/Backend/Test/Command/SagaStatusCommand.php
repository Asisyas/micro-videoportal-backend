<?php

namespace App\Backend\Test\Command;

use App\Saga\VideoPublish\Activity\VideoPublishActivityInterface;
use App\Saga\VideoPublish\Workflow\VideoPublishWorkflowInterface;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SagaStatusCommand extends Command
{
    public function __construct(
        private readonly TemporalFacadeInterface $temporalFacade
    )
    {
        parent::__construct('test:saga:status');
    }

    public function configure()
    {
        $this->addArgument('workflow-id', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $wf = $this->temporalFacade->workflowClient()->newRunningWorkflowStub(
            VideoPublishWorkflowInterface::class,
            $input->getArgument('workflow-id'),
        );

        dump($wf->lookupStatus());

        return self::SUCCESS;
    }
}
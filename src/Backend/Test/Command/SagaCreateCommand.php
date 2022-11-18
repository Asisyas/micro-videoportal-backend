<?php

namespace App\Backend\Test\Command;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Saga\VideoPublish\VideoPublishWorkflowInterface;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SagaCreateCommand extends Command
{
    public function __construct(private readonly TemporalFacadeInterface $temporalFacade)
    {
        parent::__construct('test:saga:create');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $fileGetTransfer = new FileGetTransfer();
        $fileGetTransfer->setId('6e91ea4b-669f-4c70-aef9-e31e6d692c61');
        $client = $this->temporalFacade->workflowClient();
        $stub = $client->newWorkflowStub(
            VideoPublishWorkflowInterface::class
        );

        $run = $client->start($stub, $fileGetTransfer);
        $output->writeln(
            sprintf(
                'Started: WorkflowID=<fg=magenta>%s</fg=magenta>, RunID=<fg=magenta>%s</fg=magenta>',
                $run->getExecution()->getID(),
                $run->getExecution()->getRunID(),
            )
        );

        $output->writeln(sprintf("Result:\n<info>%s</info>", 'TEST', true));


        return self::SUCCESS;
    }
}
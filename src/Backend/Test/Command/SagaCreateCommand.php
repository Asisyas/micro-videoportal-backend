<?php

namespace App\Backend\Test\Command;

use App\Backend\Test\Activity\TestActivityStubInterface;
use App\Backend\Test\Workflow\TestWorkflowInterface;
use App\Saga\VideoPublish\Workflow\VideoPublishWorkflowInterface;
use App\Saga\VideoUpload\Workflow\VideoUploadWorkflowInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\User\UserTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
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
        $fileGetTransfer->setId('88c2917e-0e3b-4f2b-8162-12f77c46fee7');
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

        $output->writeln(sprintf("Result:\n<info>%s</info>", print_r($run->getResult(), true)));


        return self::SUCCESS;
    }
}
<?php

namespace App\Backend\Test\Command;

use App\Backend\Test\Activity\TestActivityStubInterface;
use App\Backend\Test\Workflow\TestWorkflowInterface;
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
        $client = $this->temporalFacade->workflowClient();
        $stub = $client->newWorkflowStub(
            VideoUploadWorkflowInterface::class
        );

        $fileGetTransfer = new FileGetTransfer();
        $fileGetTransfer->setId('796a41d6-f495-4789-8a9b-c4d65749fa33');

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
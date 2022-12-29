<?php

namespace App\Backend\Test\Command;

use App\Backend\VideoPublish\Facade\VideoPublishFacade;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use App\Shared\Saga\VideoPublish\VideoPropagateWorkflowInterface;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VideoPropagateCommand extends Command
{
    public function __construct(
        private readonly TemporalFacadeInterface $temporalFacade
    ) {
        parent::__construct('test:video:propagate');
    }

    public function configure(): void
    {
        $this->addArgument('video-id', InputArgument::REQUIRED);
    }

    /**
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $videoGetTransfer = new VideoGetTransfer();
        $videoGetTransfer->setVideoId($input->getArgument('video-id'));

        $this->temporalFacade
            ->workflowClient()
            ->newWorkflowStub(VideoPropagateWorkflowInterface::class)
            ->propagateVideo($videoGetTransfer);

        return self::SUCCESS;
    }
}

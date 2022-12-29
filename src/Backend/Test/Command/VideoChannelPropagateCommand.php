<?php

namespace App\Backend\Test\Command;

use App\Shared\Generated\DTO\Video\VideoChannelGetTransfer;
use App\Shared\VideoChannel\Saga\VideoChannelPropagateWorkflowInterface;
use Micro\Plugin\Temporal\Facade\TemporalFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VideoChannelPropagateCommand extends Command
{
    public function __construct(
        private readonly TemporalFacadeInterface $temporalFacade
    ) {
        parent::__construct('test:channel:propagate');
    }

    public function configure(): void
    {
        $this->addArgument('channel-id', InputArgument::REQUIRED);
    }

    /**
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $channelGetTransfer = new VideoChannelGetTransfer();
        $channelGetTransfer->setChannelId($input->getArgument('channel-id'));

        $workflow = $this->temporalFacade
            ->workflowClient()
            ->newWorkflowStub(VideoChannelPropagateWorkflowInterface::class);

        $result = $this->temporalFacade->workflowClient()->start($workflow, $channelGetTransfer);

        dump($result->getResult());

        return self::SUCCESS;
    }
}

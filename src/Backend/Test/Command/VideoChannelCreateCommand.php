<?php

namespace App\Backend\Test\Command;

use App\Client\VideoChannel\Client\VideoChannelClientInterface;
use App\Shared\Generated\DTO\Video\VideoChannelCreateTransfer;
use App\Shared\Saga\VideoPublish\VideoPropagateWorkflowInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VideoChannelCreateCommand extends Command
{
    public function __construct(
        private readonly VideoChannelClientInterface $channelClient
    ) {
        parent::__construct('test:video:channel-create');
    }

    public function configure(): void
    {
        $this->addArgument('channel-id', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $channelCreateTransfer = new VideoChannelCreateTransfer();
        $channelCreateTransfer->setId($input->getArgument('channel-id'));
        $channelCreateTransfer->setTitle('Channel title');
        $channelCreateTransfer->setOwnerId('test-ownet-id');

        try {
            $channel = $this->channelClient->createChannel($channelCreateTransfer);

            dump($channel);
        } catch (\Throwable $exception) {
            dump($exception);
        }

        return self::SUCCESS;
    }
}

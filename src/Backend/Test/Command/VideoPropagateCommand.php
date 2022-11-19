<?php

namespace App\Backend\Test\Command;

use App\Backend\VideoPublish\Facade\VideoPublishFacade;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VideoPropagateCommand extends Command
{
    public function __construct(
        private readonly VideoPublishFacade $videoPublishFacade
    )
    {
        parent::__construct('test:video:propagate');
    }

    public function configure()
    {
        $this->addArgument('video-id', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $videoGetTransfer = new VideoGetTransfer();
        $videoGetTransfer->setVideoId($input->getArgument('video-id'));

        $this->videoPublishFacade->propagateVideo($videoGetTransfer);

        return self::SUCCESS;
    }
}
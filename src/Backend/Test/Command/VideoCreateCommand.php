<?php

namespace App\Backend\Test\Command;

use App\Client\Video\Client\VideoClientInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class VideoCreateCommand extends Command
{
    public function __construct(
        private readonly VideoClientInterface $videoClient
    )
    {
        parent::__construct('test:video:create');
    }

    public function configure()
    {
        $this->addArgument('file_id', InputOption::VALUE_REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $videoCreateTransfer = new VideoCreateTransfer();
        $videoCreateTransfer->setFileId($input->getArgument('file_id'));

        $result = $this->videoClient->createVideo($videoCreateTransfer);

        dump($result);

        return self::SUCCESS;
    }

}
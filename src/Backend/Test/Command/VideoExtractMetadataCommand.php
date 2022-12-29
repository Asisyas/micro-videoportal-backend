<?php

namespace App\Backend\Test\Command;

use App\Backend\MediaConverter\Facade\MediaConverterFacadeInterface;
use App\Client\File\FileClientInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class VideoExtractMetadataCommand extends Command
{
    public function __construct(
        private readonly MediaConverterFacadeInterface $videoConverterFacade,
        private readonly FileClientInterface           $fileClient
    ) {
        parent::__construct('test:video:meta');
    }

    public function configure(): void
    {
        $this->addArgument('video_id', InputOption::VALUE_REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $videoFile = $input->getArgument('video_id');
        $fileGet = new FileGetTransfer();
        $fileGet->setId($videoFile);
        $file = $this->fileClient->lookupFile($fileGet);
        $meta = $this->videoConverterFacade->extractMediaMetadata($file);
        dump($meta);
        dump($this->videoConverterFacade->calculateMediaResolutions($meta));

        return self::SUCCESS;
    }
}

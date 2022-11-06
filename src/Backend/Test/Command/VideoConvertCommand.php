<?php

namespace App\Backend\Test\Command;

use App\Backend\VideoConverter\Facade\VideoConverterFacadeInterface;
use App\Client\File\FileClientInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\VideoConverter\ResolutionTransfer;
use App\Shared\Generated\DTO\VideoConverter\VideoConvertTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class VideoConvertCommand extends Command
{
    public function __construct(
        private readonly VideoConverterFacadeInterface $videoConverterFacade,
        private readonly FileClientInterface $fileClient
    )
    {
        parent::__construct('test:video:convert');
    }

    public function configure()
    {
        parent::configure();

        $this->addArgument('video_id', InputOption::VALUE_REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $videoFile = $input->getArgument('video_id');
        $fileGet = new FileGetTransfer();
        $fileGet->setId($videoFile);
        $file = $this->fileClient->lookupFile($fileGet);

        $metadata = $this->videoConverterFacade->extractVideoMetadata($file);
        $videoStreamMeta = $metadata->getStreamVideo();

        $videoConvert = new VideoConvertTransfer();
        $videoConvert
            ->setMeta($metadata)
            ->setResolution(
                (new ResolutionTransfer())
                ->setHeight($videoStreamMeta->getHeight())
                ->setWidth($videoStreamMeta->getWidth())
            )
            ->setFile($file)
        ;

        $result = $this->videoConverterFacade->convertVideo($file, (new \App\Shared\Generated\DTO\Video\ResolutionTransfer())
            ->setHeight(240)
            ->setWidth(426)
        );

        dump($result);

        return self::SUCCESS;
    }
}
<?php

namespace App\Backend\Test\Command;

use App\Backend\MediaConverter\Facade\MediaConverterFacadeInterface;
use App\Client\File\Client\ClientFileInterface;
use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use App\Shared\Generated\DTO\MediaConverter\ResolutionTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class VideoConvertCommand extends Command
{
    public function __construct(
        private readonly MediaConverterFacadeInterface $videoConverterFacade,
        private readonly ClientFileInterface $fileClient
    ) {
        parent::__construct('test:video:convert');
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

        $metadata = $this->videoConverterFacade->extractMediaMetadata($file);
        $resolutions = $this->videoConverterFacade->calculateMediaResolutions($metadata);
        $mediaConfiguration = new MediaConfigurationTransfer();
        $mediaConfiguration
            ->setFile($file);

        $results = [];

        dump($metadata);

        foreach ($resolutions->getResolutions() as $resolution) {
            $mediaConfiguration->setResolutionConfiguration($resolution);

            dump($mediaConfiguration);

            $result = $this->videoConverterFacade->convert(
                $mediaConfiguration,
                function ($a = null, $b = null, $c = null) {
                    dump($a, $b, $c);
                }
            );

            $output->writeln(
                sprintf('Converted %s', $result->getSrc())
            );

            $results[] = $result;
        }

        dump($results);

        return self::SUCCESS;
    }
}

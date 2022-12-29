<?php

namespace App\Backend\Test\Command;

use App\Backend\MediaConverter\Facade\MediaConverterFacadeInterface;
use App\Backend\MediaConverter\MediaConverterPluginConfiguration;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultCollectionTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConvertedResultTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaResolutionTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateDashCommand extends Command
{
    public function __construct(
        private readonly MediaConverterFacadeInterface $videoConverterFacade,
    ) {
        parent::__construct('test:video:dash');
    }

    /**
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $mediaConverterResultCollection = new MediaConvertedResultCollectionTransfer();
        $mediaConverterResultCollection->setVideoId('0726a98b-3d0e-4610-b51f-7ec1415fce40');
        $mcrtc = [];
        $files = [
            ['0726a98b-3d0e-4610-b51f-7ec1415fce40_video-426x240-1000Kb.webm', true],
            ['0726a98b-3d0e-4610-b51f-7ec1415fce40_audio-128Kb.webm', false],
            ['0726a98b-3d0e-4610-b51f-7ec1415fce40_video-426x240-500Kb.webm', true],
            ['0726a98b-3d0e-4610-b51f-7ec1415fce40_video-640x360-1000Kb.webm', true]
        ];


        foreach ($files as $file) {
            $mediaConverterResult = new MediaConvertedResultTransfer();
            $mediaConverterResult
                ->setSrc($file[0])
                ->setResolution(
                    (new MediaResolutionTransfer())
                        ->setMediaTypeFlag(
                            $file[1] ?
                            MediaConverterPluginConfiguration::FLAG_VIDEO :
                            MediaConverterPluginConfiguration::FLAG_AUDIO
                        )
                );
            $mcrtc[] = $mediaConverterResult;
        }

        $mediaConverterResultCollection->setResults($mcrtc);

        $result = $this->videoConverterFacade->generateDashManifest($mediaConverterResultCollection);

        dump($result);

        return self::SUCCESS;
    }
}

<?php

namespace App\Backend\Test\Command;

use FFMpeg\Format\Video\WebM;
use Micro\Plugin\Ffmpeg\Facade\FfmpegFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class VideoConvertCommand extends Command
{
    public function __construct(
        private readonly FfmpegFacadeInterface $ffmpegFacade
    )
    {
        parent::__construct('test:video:convert');
    }

    public function configure()
    {
        parent::configure();

        $this->addArgument('videofile');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $videoFile = $input->getArgument('videofile');
        $media = $this->ffmpegFacade->open($videoFile);

        $format = new WebM('libvorbis', 'libvpx-vp9');
        $format->setAdditionalParameters();

        $io = new SymfonyStyle($input, $output);
        $pb = $io->createProgressBar();
        $pb->setMaxSteps(100);
        $format->on('progress', function ($video, $format, $percentage) use ($pb) {
            $pb->setProgress((int) $percentage);
        });

        $media->save($format, '/home/kost/Videos/conwerted.webm');

        return self::SUCCESS;
    }
}
<?php

declare(strict_types=1);

/**
 * This file is part of the Micro framework package.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Backend\Test\Command;

use App\Backend\Video\VideoThumbnail\Facade\VideoThumbnailFacadeInterface;
use App\Client\Video\Client\ClientVideoInterface;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class TestVideoThumbnailCommand extends Command
{
    public function __construct(
        private readonly VideoThumbnailFacadeInterface $videoThumbnailGeneratorFacade
    ) {
        parent::__construct('test:video:thumbnail');
    }

    public function configure(): void
    {
        $this->addArgument('video-id', InputArgument::REQUIRED, 'Video ID');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $videoGet = new VideoGetTransfer();
        $videoGet->setVideoId($input->getArgument('video-id'));

        $this->videoThumbnailGeneratorFacade->generateThumbnail($videoGet);

        return self::SUCCESS;
    }
}

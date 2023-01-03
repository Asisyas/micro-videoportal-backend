<?php

namespace App\Backend\Test\Command;

use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Client\Video\Client\ClientVideoInterface;
use App\Shared\Generated\DTO\Search\IndexAddTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestSearchAddCommand extends Command
{
    public function __construct(
        private readonly SearchStorageFacadeInterface $searchStorageFacade,
        private readonly ClientVideoInterface $videoClient
    ) {
        parent::__construct('test:video:index');
    }

    public function configure(): void
    {
        $this->addArgument('video-id', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $videoGetTransfer = new VideoGetTransfer();
        $videoGetTransfer->setVideoId($input->getArgument('video-id'));

        $videoTransfer = $this->videoClient->lookupVideo($videoGetTransfer);

        $indexAddTransfer = new IndexAddTransfer();
        $indexAddTransfer->setId($videoTransfer->getId());
        $indexAddTransfer->setIndex('video');
        $indexAddTransfer->setBody($videoTransfer);

        $this->searchStorageFacade->index($indexAddTransfer);

        return self::SUCCESS;
    }
}

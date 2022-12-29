<?php

namespace App\Backend\Test\Command;

use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Client\Video\Client\VideoClientInterface;
use App\Shared\Generated\DTO\Search\IndexAddTransfer;
use App\Shared\Generated\DTO\Video\VideoWatchTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestSearchAddCommand extends Command
{
    public function __construct(
        private readonly SearchStorageFacadeInterface $searchStorageFacade,
        private readonly VideoClientInterface $videoClient
    ) {
        parent::__construct('test:video:index');
    }

    public function configure(): void
    {
        $this->addArgument('video-id', InputArgument::REQUIRED);
    }

    /**
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $videoGetTransfer = new VideoWatchTransfer();
        $videoGetTransfer->setId($input->getArgument('video-id'));

        $videoTransfer = $this->videoClient->lookupVideo($videoGetTransfer);

        $indexAddTransfer = new IndexAddTransfer();
        $indexAddTransfer->setId($videoTransfer->getId());
        $indexAddTransfer->setIndex('video');
        $indexAddTransfer->setBody($videoTransfer);

        $this->searchStorageFacade->index($indexAddTransfer);

        return self::SUCCESS;
    }
}

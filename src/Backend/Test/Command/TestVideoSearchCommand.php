<?php

namespace App\Backend\Test\Command;

use App\Backend\SearchStorage\Facade\SearchStorageFacadeInterface;
use App\Client\Search\Client\SearchClientInterface;
use App\Client\Video\Client\VideoClientInterface;
use App\Shared\Generated\DTO\Search\IndexAddTransfer;
use App\Shared\Generated\DTO\Search\SearchTransfer;
use App\Shared\Generated\DTO\Video\VideoGetTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestVideoSearchCommand extends Command
{
    public function __construct(
        private readonly SearchClientInterface $searchClient
    )
    {
        parent::__construct('test:video:search');
    }

    public function configure()
    {
        $this->addArgument('search-string', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $searchTransfer = new SearchTransfer();
        $searchTransfer->setIndex('video');
        $searchTransfer->setQuery([
            'query' => [
                'fuzzy' => [
                    'name'  => [
                        'value' => $input->getArgument('search-string'),
                        "boost" =>        1.0,
                        "fuzziness" =>     2,
                        "prefix_length"  => 2,
                        "max_expansions" => 100
                    ]
                ]
            ]
        ]);

        $result = $this->searchClient->search($searchTransfer);

        dd($result['hits']);

        return self::SUCCESS;
    }

}
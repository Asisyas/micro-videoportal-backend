<?php

namespace App\Backend\Test\Command;

use App\Client\Search\Client\SearchClientInterface;
use App\Shared\Generated\DTO\Search\SearchTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestVideoSearchCommand extends Command
{
    public function __construct(
        private readonly SearchClientInterface $searchClient
    ) {
        parent::__construct('test:video:search');
    }

    public function configure(): void
    {
        $this->addArgument('search-string', InputArgument::REQUIRED);
    }

    /**
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $searchTransfer = new SearchTransfer();
        $searchTransfer->setIndex('video');
        /*$searchTransfer->setQuery([
            'query' => [
                'fuzzy' => [
                    'title'  => [
                        'value' => $input->getArgument('search-string'),
                        "boost" =>        1.0,
                        "fuzziness" =>     2,
                        "prefix_length"  => 2,
                        "max_expansions" => 100
                    ]
                ]
            ]
        ]);
        */
        /*
        $searchTransfer->setQuery([
            'query' => [
                'bool'  => [
                    'should'    => [
                        [
                            'match' => [
                                'title' => $input->getArgument('search-string'),
                            ]
                        ]
                    ]
                ]
            ]
        ]);
        */

        $searchTransfer->setQuery([
            '_source' => false,
        ]);


        $result = $this->searchClient->search($searchTransfer);

        dump($result);

        return self::SUCCESS;
    }
}

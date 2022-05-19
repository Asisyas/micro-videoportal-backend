<?php

namespace App\Backend\DataSource\Console;

use App\Client\DataSource\Client\DataSourceClientInterface;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewDataSourceCommand  extends Command
{
    public function __construct(private readonly DataSourceClientInterface $dataSourceClient)
    {
        parent::__construct('pp:ds:view');
    }

    public function configure()
    {
        $this->addArgument('uuid');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->dataSourceClient->lookup($input->getArgument('uuid'));

        $output->writeln(json_encode($response, JSON_PRETTY_PRINT));

        return Command::SUCCESS;
    }

}
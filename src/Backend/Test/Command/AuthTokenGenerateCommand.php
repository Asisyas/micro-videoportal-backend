<?php

namespace App\Backend\Test\Command;

use App\Shared\Generated\DTO\File\FileGetTransfer;
use App\Shared\Generated\DTO\MediaConverter\MediaConfigurationTransfer;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AuthTokenGenerateCommand extends Command
{
    public function __construct(
        private readonly SecurityFacadeInterface $securityFacade
    ) {
        parent::__construct('test:token:generate');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $token = $this->securityFacade->generateToken([
            'user'  => [
                'uuid'  => 'test-user-uuid',
                'roles' => [
                    'ROLE_USER'
                ],
                'username'  => 'user@videoportal'
            ],
            ''
        ]);

        dump($token);

        return self::SUCCESS;
    }
}

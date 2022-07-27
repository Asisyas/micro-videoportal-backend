<?php

namespace App\Frontend\User\Controller;

use App\Client\User\UserClientInterface;
use App\Shared\Generated\DTO\User\UserCreateTransfer;
use App\Shared\User\Configuration;
use Micro\Plugin\Http\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

class UserCreateController
{
    public function __construct(private readonly UserClientInterface $userClient)
    {
    }

    /**
     * @param Request $request
     * @return mixed
     *
     * @throws BadRequestException
     */
    public function createUser(Request $request): mixed
    {
        $username = $request->get('username');
        if(!$username) {
            throw new BadRequestException('Username is null');
        }

        $userCreateTransfer = new UserCreateTransfer();
        $userCreateTransfer->setUsername($username);
        $userCreateTransfer->setRoles([
            Configuration::ROLE_USER,
        ]);

        return $this->userClient->createUser($userCreateTransfer);
    }
}
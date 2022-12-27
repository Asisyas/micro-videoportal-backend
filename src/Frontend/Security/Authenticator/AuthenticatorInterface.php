<?php

namespace App\Frontend\Security\Authenticator;

use App\Frontend\Security\Token\Model\AuthTokenInterface;
use Micro\Plugin\Http\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;

interface AuthenticatorInterface
{
    /**
     * @param Request $request
     *
     * @throws HttpException
     */
    public function authenticateRequest(Request $request): AuthTokenInterface;
}

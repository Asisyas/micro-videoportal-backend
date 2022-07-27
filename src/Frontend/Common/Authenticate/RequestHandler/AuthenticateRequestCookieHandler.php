<?php

namespace App\Frontend\Common\Authenticate\RequestHandler;

use Micro\Plugin\Http\Exception\BadRequestException;
use Micro\Plugin\Http\Handler\Request\RequestHandlerContextInterface;
use Micro\Plugin\Http\Handler\Request\RequestHandlerInterface;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;

class AuthenticateRequestCookieHandler implements RequestHandlerInterface
{
    public function __construct(private readonly SecurityFacadeInterface $securityFacade)
    {
    }

    public function handle(RequestHandlerContextInterface $requestHandlerContext): void
    {
        $tokenRaw = $requestHandlerContext->getRequest()->cookies->get('AUTH_TOKEN');
        if(!$tokenRaw) {
            return;
        }

        try {
            $token = $this->securityFacade->decodeToken($tokenRaw);
        } catch (\UnexpectedValueException $exception) {
            throw new BadRequestException('Invalid authentication token.');
        }
    }
}
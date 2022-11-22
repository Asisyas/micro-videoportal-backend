<?php

namespace App\Frontend\Security\Handler\Request;

use App\Frontend\Security\Facade\SecurityFacadeInterface;
use Micro\Plugin\Http\Handler\Request\RequestHandlerContextInterface;
use Micro\Plugin\Http\Handler\Request\RequestHandlerInterface;

class RequestHeaderAuthenticateHandler implements RequestHandlerInterface
{
    /**
     * @param SecurityFacadeInterface $securityFacade
     */
    public function __construct(
        private readonly SecurityFacadeInterface $securityFacade
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function handle(RequestHandlerContextInterface $requestHandlerContext): void
    {
        $this->securityFacade->authenticateRequest($requestHandlerContext->getRequest());
    }
}
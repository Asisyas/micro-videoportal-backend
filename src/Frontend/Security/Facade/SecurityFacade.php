<?php

namespace App\Frontend\Security\Facade;

use App\Frontend\Security\Authenticator\AuthenticatorFactoryInterface;
use App\Frontend\Security\Token\Model\AuthTokenInterface;
use Symfony\Component\HttpFoundation\Request;

class SecurityFacade implements SecurityFacadeInterface
{
    /**
     * @var AuthTokenInterface
     */
    private readonly AuthTokenInterface $authToken;

    /**
     * @param AuthenticatorFactoryInterface $authenticatorFactory
     */
    public function __construct(
        private readonly AuthenticatorFactoryInterface $authenticatorFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function authenticateRequest(Request $request): AuthTokenInterface
    {
        $this->authToken = $this->authenticatorFactory->create()->authenticateRequest($request);

        return $this->authToken;
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthToken(): AuthTokenInterface
    {
        return $this->authToken;
    }
}
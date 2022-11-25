<?php

namespace App\Frontend\Security\Authenticator;

use App\Frontend\Security\Configuration\SecurityPluginConfigurationInterface;
use App\Frontend\Security\Token\Factory\AuthTokenFactoryInterface;
use App\Frontend\Security\Token\Model\AuthTokenInterface;
use Micro\Plugin\Http\Exception\HttpBadRequestException;
use Micro\Plugin\Http\Exception\HttpAccessDeniedException;
use Micro\Plugin\Security\Exception\TokenExpiredException;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;
use Symfony\Component\HttpFoundation\Request;

class HeaderAuthenticator implements AuthenticatorInterface
{
    /**
     * @param SecurityFacadeInterface $securityFacade
     * @param AuthTokenFactoryInterface $authTokenFactory
     * @param SecurityPluginConfigurationInterface $pluginConfiguration
     */
    public function __construct(
        private readonly SecurityFacadeInterface $securityFacade,
        private readonly AuthTokenFactoryInterface $authTokenFactory,
        private readonly SecurityPluginConfigurationInterface $pluginConfiguration
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function authenticateRequest(Request $request): AuthTokenInterface
    {
        $tokenRaw = $request->headers->get($this->pluginConfiguration->getAuthHeaderName());
        if(!$tokenRaw) {
            throw new HttpAccessDeniedException('Authentication token was not found.');
        }

        try {
            $token = $this->securityFacade->decodeToken($tokenRaw);
        } catch (\UnexpectedValueException $exception) {
            throw new HttpBadRequestException('Invalid authentication token.', $exception);
        } catch (TokenExpiredException $exception) {
            throw new HttpAccessDeniedException('Authentication token was expired.');
        }

        return $this->authTokenFactory->create($token);
    }
}
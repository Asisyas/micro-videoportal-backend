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
    const TOKEN_NOT_FOUND   = 'Authentication token was not found.';
    const TOKEN_INVALID     = 'Invalid authentication token';
    const TOKEN_EXPIRED     = 'Authentication token was expired.';

    /**
     * @param SecurityFacadeInterface               $securityFacade
     * @param AuthTokenFactoryInterface             $authTokenFactory
     * @param SecurityPluginConfigurationInterface  $pluginConfiguration
     */
    public function __construct(
        private readonly SecurityFacadeInterface                $securityFacade,
        private readonly AuthTokenFactoryInterface              $authTokenFactory,
        private readonly SecurityPluginConfigurationInterface   $pluginConfiguration
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function authenticateRequest(Request $request): AuthTokenInterface
    {
        $tokenRawData = $request->headers->get($this->pluginConfiguration->getAuthHeaderName());
        if(!$tokenRawData) {
            throw new HttpAccessDeniedException(self::TOKEN_NOT_FOUND);
        }

        preg_match('/Bearer\s((.*)\.(.*)\.(.*))/', $tokenRawData, $tokenRawDataExploded);

        $tokenRaw = $tokenRawDataExploded[1] ?? null;

        if(!$tokenRaw) {
            throw new HttpBadRequestException(self::TOKEN_INVALID);
        }

        try {
            $token = $this->securityFacade->decodeToken($tokenRaw);
        } catch (\UnexpectedValueException $exception) {
            throw new HttpBadRequestException(self::TOKEN_INVALID, $exception);
        } catch (TokenExpiredException $exception) {
            throw new HttpAccessDeniedException(self::TOKEN_EXPIRED);
        }

        return $this->authTokenFactory->create($token);
    }
}
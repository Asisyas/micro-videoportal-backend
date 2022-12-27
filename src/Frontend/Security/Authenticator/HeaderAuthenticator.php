<?php

namespace App\Frontend\Security\Authenticator;

use App\Client\Security\Client\SecurityClientInterface;
use App\Frontend\Security\Configuration\SecurityPluginConfigurationInterface;
use App\Frontend\Security\Token\Factory\AuthTokenFactoryInterface;
use App\Frontend\Security\Token\Model\AuthTokenInterface;
use App\Shared\Generated\DTO\Security\TokenTransfer;
use Micro\Plugin\Http\Exception\HttpBadRequestException;
use Micro\Plugin\Http\Exception\HttpAccessDeniedException;
use Micro\Plugin\Security\Exception\TokenExpiredException;
use Symfony\Component\HttpFoundation\Request;

class HeaderAuthenticator implements AuthenticatorInterface
{
    public const TOKEN_NOT_FOUND   = 'Authentication token was not found.';
    public const TOKEN_INVALID     = 'Invalid authentication token';

    /**
     * @param SecurityClientInterface $securityClient
     * @param AuthTokenFactoryInterface $authTokenFactory
     * @param SecurityPluginConfigurationInterface $pluginConfiguration
     */
    public function __construct(
        private readonly SecurityClientInterface                $securityClient,
        private readonly AuthTokenFactoryInterface              $authTokenFactory,
        private readonly SecurityPluginConfigurationInterface   $pluginConfiguration
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function authenticateRequest(Request $request): AuthTokenInterface
    {
        $tokenRawData = $request->headers->get($this->pluginConfiguration->getAuthHeaderName());
        if (!$tokenRawData) {
            throw new HttpAccessDeniedException(self::TOKEN_NOT_FOUND);
        }

        preg_match('/Bearer\s((.*)\.(.*)\.(.*))/', $tokenRawData, $tokenRawDataExploded);

        $tokenRaw = $tokenRawDataExploded[1] ?? null;

        if (!$tokenRaw) {
            throw new HttpBadRequestException(self::TOKEN_INVALID);
        }

        $tokenTransfer = new TokenTransfer();
        $tokenTransfer->setToken($tokenRaw);

        try {
            $this->securityClient->decodeToken($tokenTransfer);
        } catch (TokenExpiredException $exception) {
            throw new HttpAccessDeniedException($exception->getMessage(), $exception);
        }
        /*
        catch (\UnexpectedValueException $exception) {
            throw new HttpBadRequestException(self::TOKEN_INVALID, $exception);
        }
        */

        return $this->authTokenFactory->create($tokenTransfer);
    }
}

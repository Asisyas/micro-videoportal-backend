<?php

declare(strict_types=1);

/**
 * This file is part of the Micro framework package.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Client\Security\Authorization;

use App\Client\Security\Authorization\Expander\SecurityTokenDataExpanderInterface;
use App\Client\Security\Authorization\Expander\TokenTransferExpanderInterface;
use App\Shared\Generated\DTO\Security\AuthCodeRequestTransfer;
use App\Shared\Generated\DTO\Security\TokenTransfer;
use Firebase\JWT\ExpiredException;
use Micro\Plugin\OAuth2\Client\Facade\Oauth2ClientFacadeInterface;
use Micro\Plugin\Security\Exception\TokenExpiredException;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;
use Micro\Plugin\Security\Token\TokenInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class AuthorizationManager implements AuthorizationManagerInterface
{
    /**
     * @param Oauth2ClientFacadeInterface $oauth2ClientFacade
     * @param SecurityFacadeInterface $securityFacade
     * @param SecurityTokenDataExpanderInterface $securityTokenDataExpander
     * @param TokenTransferExpanderInterface $tokenTransferExpander
     */
    public function __construct(
        private readonly Oauth2ClientFacadeInterface $oauth2ClientFacade,
        private readonly SecurityFacadeInterface $securityFacade,
        private readonly SecurityTokenDataExpanderInterface $securityTokenDataExpander,
        private readonly TokenTransferExpanderInterface $tokenTransferExpander
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function authorizeByCode(AuthCodeRequestTransfer $authCodeRequestTransfer): TokenTransfer
    {
        $tokenData      = [];
        $providerName   = $authCodeRequestTransfer->getProvider();
        $code           = $authCodeRequestTransfer->getCode();
        $provider       = $this->oauth2ClientFacade->getProvider($providerName);
        $accessToken    = $provider->getAccessToken('authorization_code', [
            'code'  => $code,
        ]);

        $tokenTransfer  = new TokenTransfer();
        $this->securityTokenDataExpander->expand($tokenData, $accessToken, $provider);

        $tokenGenerated = $this->securityFacade->generateToken($tokenData);
        $this->tokenTransferExpander->expand($tokenTransfer, $tokenGenerated);

        return $tokenTransfer;
    }

    /**
     * {@inheritDoc}
     */
    public function refreshToken(TokenTransfer $tokenTransfer): void
    {
        $encoded    = $tokenTransfer->getToken();
        $decoded    = $this->securityFacade->decodeToken($encoded);
        $provider   = $this->oauth2ClientFacade->getProvider('default');
        $tokenData  = [];

        $tokenGenerated = $provider->getAccessToken('refresh_token', [
            'refresh_token' => $decoded->getParameter('rt', ''),
        ]);

        $this->securityTokenDataExpander->expand($tokenData, $tokenGenerated, $provider);
        $tokenGenerated = $this->securityFacade->generateToken($tokenData);
        $this->tokenTransferExpander->expand($tokenTransfer, $tokenGenerated);
    }

    /**
     * {@inheritDoc}
     */
    public function decodeToken(TokenTransfer $tokenTransfer): void
    {
        try {
            $tokenData = $this->securityFacade->decodeToken($tokenTransfer->getToken());
        } catch (ExpiredException $exception) {
            throw new TokenExpiredException($tokenTransfer->getToken(), $exception);
        }

        $this->checkAccessTokenExpired($tokenData);

        $this->tokenTransferExpander->expand($tokenTransfer, $tokenData);
    }

    /**
     * @param TokenInterface $token
     *
     * @return void
     */
    protected function checkAccessTokenExpired(TokenInterface $token): void
    {
        $tokenExpTime = (int) $token->getParameter('exp_ta', null);
        if (!$tokenExpTime) {
            return;
        }

        if (time() >= $tokenExpTime) {
            throw new TokenExpiredException($token->getSource());
        }
    }
}

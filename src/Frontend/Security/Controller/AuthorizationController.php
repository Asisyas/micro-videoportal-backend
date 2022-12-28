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

namespace App\Frontend\Security\Controller;

use App\Client\Security\Client\SecurityClientInterface;
use App\Shared\Generated\DTO\Security\AuthCodeRequestTransfer;
use App\Shared\Generated\DTO\Security\TokenTransfer;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Micro\Plugin\Http\Exception\HttpAccessDeniedException;
use Micro\Plugin\Http\Exception\HttpBadRequestException;
use Micro\Plugin\Security\Exception\TokenExpiredException;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class AuthorizationController
{
    /**
     * @param SecurityClientInterface $securityClient
     */
    public function __construct(
        private readonly SecurityClientInterface $securityClient
    ) {
    }

    /**
     * @param Request $request
     *
     * @throws HttpAccessDeniedException
     * @throws HttpBadRequestException
     */
    public function processCodeRequest(Request $request): TokenTransfer
    {
        $codeParameter = 'code';
        if (!$request->query->has($codeParameter)) {
            $this->throwInvalidParameterException('code');
        }

        $code = (string) $request->query->get($codeParameter);
        if (empty($code)) {
            $this->throwInvalidParameterException('code');
        }

        $provider = 'default';
        $authCodeRequestTransfer = new AuthCodeRequestTransfer();
        $authCodeRequestTransfer
            ->setCode($code)
            ->setProvider($provider)
        ;

        try {
            return $this->securityClient->authorizeByCode($authCodeRequestTransfer);
        } catch (IdentityProviderException $exception) {
            throw new HttpAccessDeniedException($exception->getMessage(), $exception);
        }
    }

    /**
     * @param Request $request
     * @return TokenTransfer
     * @throws HttpAccessDeniedException
     *
     * @throws HttpBadRequestException
     */
    public function refreshToken(Request $request): TokenTransfer
    {
        if (!$request->query->has('token')) {
            $this->throwInvalidParameterException('token');
        }

        $tokenRaw = (string) $request->query->get('token');
        $tokenTransfer = new TokenTransfer();
        $tokenTransfer->setToken($tokenRaw);
        try {
            $this->securityClient->refreshToken($tokenTransfer);

            return $tokenTransfer;
        } catch (IdentityProviderException|TokenExpiredException $exception) {
            throw new HttpAccessDeniedException($exception->getMessage(), $exception);
        }
    }

    /**
     * @param string $parameter
     *
     * @return void
     *
     * @throws HttpBadRequestException
     */
    protected function throwInvalidParameterException(string $parameter): void
    {
        throw new HttpBadRequestException(sprintf('The "%s" parameter is missing or invalid in the request.', $parameter));
    }
}

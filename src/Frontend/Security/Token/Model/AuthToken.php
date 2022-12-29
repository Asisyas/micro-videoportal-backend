<?php

namespace App\Frontend\Security\Token\Model;

use App\Shared\Generated\DTO\Security\TokenTransfer;

class AuthToken implements AuthTokenInterface
{
    /**
     * @param TokenTransfer $token
     */
    public function __construct(private readonly TokenTransfer $token)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getUserId(): null|string
    {
        return $this->token->getUser()->getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function getExpired(): int|null
    {
        return $this->token->getExpiresAtAccess();
    }

    /**
     * {@inheritDoc}
     *
     * @return null|string
     */
    public function getSource(): string|null
    {
        return $this->token->getToken();
    }
}

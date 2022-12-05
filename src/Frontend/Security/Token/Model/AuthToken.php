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
    public function getExpired(): int
    {
        return $this->token->getExpiresAtAccess();
    }

    /**
     * {@inheritDoc}
     */
    public function getSource(): string
    {
        return $this->token->getToken();
    }
}
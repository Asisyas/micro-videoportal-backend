<?php

namespace App\Frontend\Security\Token\Model;

use Micro\Plugin\Security\Token\TokenInterface;

class AuthToken implements AuthTokenInterface
{
    /**
     * @param TokenInterface $token
     */
    public function __construct(private readonly TokenInterface $token)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getUserId(): null|string
    {
        return $this->getParameter(self::PARAM_USER_ID, null);
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles(): array
    {
        return $this->getParameter(self::PARAM_ROLES, []);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt(): int
    {
        return $this->token->getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getLifetime(): int
    {
        return $this->token->getLifetime();
    }

    /**
     * {@inheritDoc}
     */
    public function getParameters(): array
    {
        return $this->token->getParameters();
    }

    /**
     * {@inheritDoc}
     */
    public function getParameter(string $parameterName, mixed $default): mixed
    {
        return $this->token->getParameter($parameterName, $default);
    }

    /**
     * {@inheritDoc}
     */
    public function getSource(): string
    {
        return $this->token->getSource();
    }
}
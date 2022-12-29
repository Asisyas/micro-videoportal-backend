<?php

namespace App\Frontend\Security\Token\Model;

interface AuthTokenInterface
{
    /**
     * @return string|null
     */
    public function getUserId(): null|string;

    /**
     * @return array
     */
    public function getRoles(): array;

    /**
     * @return int
     */
    public function getExpired(): int;
}

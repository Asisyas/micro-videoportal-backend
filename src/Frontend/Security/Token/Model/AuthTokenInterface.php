<?php

namespace App\Frontend\Security\Token\Model;

interface AuthTokenInterface
{
    /**
     * @return string|null
     */
    public function getUserId(): null|string;
}

<?php

namespace App\Frontend\Common\Validator;

use Micro\Plugin\Http\Exception\HttpBadRequestException;

interface ValidatorInterface
{
    /**
     * @param array $source
     *
     * @throws HttpBadRequestException
     */
    public function validate(array $source): void;
}
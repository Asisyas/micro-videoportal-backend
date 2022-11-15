<?php

namespace App\Frontend\Common\Validator;

use Micro\Plugin\Http\Exception\BadRequestException;

interface ValidatorInterface
{
    /**
     * @param array $source
     *
     * @throws BadRequestException
     */
    public function validate(array $source): void;
}
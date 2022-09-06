<?php

namespace App\Frontend\Common\Validator\ArrayObject;

use App\Frontend\Common\Validator\ValidatorInterface;

interface ArrayValidatorFactoryInterface
{
    /**
     * @param array $source
     *
     * @return ValidatorInterface
     */
    public function create(array $source): ValidatorInterface;
}
<?php

namespace App\Frontend\Common\Validator\ArrayObject;

use App\Frontend\Common\Validator\ValidatorInterface;

interface ArrayValidatorFactoryInterface
{
    /**
     * @return ValidatorInterface
     */
    public function create(): ValidatorInterface;
}

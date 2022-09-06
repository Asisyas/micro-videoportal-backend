<?php

namespace App\Frontend\File\Validator\Stream;

use App\Frontend\Common\Validator\ArrayObject\ArrayValidatorFactoryInterface;
use App\Frontend\Common\Validator\ValidatorInterface;

class CreateStreamRequestValidatorFactory implements ArrayValidatorFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(array $source): ValidatorInterface
    {
        return new CreateStreamRequestValidator($source);
    }
}
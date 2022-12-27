<?php

namespace App\Frontend\VideoPublish\Validator;

use App\Frontend\Common\Validator\ArrayObject\ArrayValidatorFactoryInterface;
use App\Frontend\Common\Validator\ValidatorInterface;

class RequestValidatorFactory implements ArrayValidatorFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): ValidatorInterface
    {
        return new RequestValidator();
    }
}

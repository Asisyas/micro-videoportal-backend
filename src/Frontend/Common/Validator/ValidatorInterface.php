<?php

namespace App\Frontend\Common\Validator;

use Micro\Plugin\Http\Exception\BadRequestException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ValidatorInterface
{
    /**
     * @return ConstraintViolationListInterface|null
     *
     * @throws BadRequestException
     */
    public function validate(): ConstraintViolationListInterface|null;
}
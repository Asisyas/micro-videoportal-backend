<?php

namespace App\Frontend\File\Facade;

use Micro\Plugin\Http\Exception\BadRequestException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface FileFacadeInterface
{
    /**
     * @param array $source
     *
     * @return ConstraintViolationListInterface|null
     *
     * @throws BadRequestException
     */
    public function validateCreateStreamRequest(array $source): ConstraintViolationListInterface|null;
}
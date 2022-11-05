<?php

namespace App\Frontend\Common\Validator\ArrayObject;

use App\Frontend\Common\Validator\ValidatorInterface;
use Micro\Plugin\Http\Exception\BadRequestException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validation;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * {@inheritDoc}
     */
    public function validate(array $source): void
    {
        $validator = Validation::createValidator();
        $result = $validator->validate(
            $source,
            $this->createValidationSchema(),
        );

        if($result->count() === 0) {
            return;
        }

        throw new BadRequestException(
            $result
        );
    }

    /**
     * @return Constraint
     */
    protected abstract function createValidationSchema(): Constraint;
}
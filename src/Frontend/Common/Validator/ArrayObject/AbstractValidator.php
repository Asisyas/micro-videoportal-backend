<?php

namespace App\Frontend\Common\Validator\ArrayObject;

use App\Frontend\Common\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @param array $source
     */
    public function __construct(private readonly array $source)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): ConstraintViolationListInterface|null
    {
        $validator = Validation::createValidator();

        $result = $validator->validate(
            $this->source,
            $this->createValidationSchema(),
        );

        if($result->count() === 0) {
            return null;
        }

        return $result;
    }

    /**
     * @return Constraint
     */
    protected abstract function createValidationSchema(): Constraint;
}
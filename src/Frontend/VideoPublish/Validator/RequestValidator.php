<?php

namespace App\Frontend\VideoPublish\Validator;

use App\Frontend\Common\Validator\ArrayObject\AbstractValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class RequestValidator extends AbstractValidator
{
    /**
     * {@inheritDoc}
     */
    protected function createValidationSchema(): Constraint
    {
        return new Assert\Collection(
            [
            'file_id'  => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'string']),
            ],
        ],
            null,
            null,
            true
        );
    }
}

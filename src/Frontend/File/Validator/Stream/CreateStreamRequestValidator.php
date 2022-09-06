<?php

namespace App\Frontend\File\Validator\Stream;

use App\Frontend\Common\Validator\ArrayObject\AbstractValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class CreateStreamRequestValidator extends AbstractValidator
{
    /**
     * @return Constraint
     */
    protected function createValidationSchema(): Constraint
    {

        return new Assert\Collection([
            'content_type'  => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'string']),
            ],
            'name'  => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'string']),
                new Assert\Length([
                    'min'   => 1,
                ]),
            ],
            'size'  => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'integer']),
                new Assert\Positive(),
            ],
        ]);
    }
}
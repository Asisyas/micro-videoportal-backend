<?php

namespace App\Frontend\File\Validator\FileUpload;

use App\Frontend\Common\Validator\ArrayObject\AbstractValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class FileUploadRequestValidator extends AbstractValidator
{
    /**
     * @param array $source
     * @return void
     *
     * @throws \Micro\Plugin\Http\Exception\HttpBadRequestException
     */
    public function validate(array $source): void
    {
        foreach ($source as $item => $value) {
            $source[$item] = $value[0];
        }

        parent::validate($source);
    }

    /**
     * @return Constraint
     */
    protected function createValidationSchema(): Constraint
    {
        return new Assert\Collection([
            'content-type'  => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'string']),
            ],
            'x-file-name'  => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'string']),
                new Assert\Length([
                    'min'   => 1,
                ]),
            ],
            'content-length'  => [
                new Assert\NotBlank(),
                new Assert\GreaterThan(1),
                new Assert\Positive(),
            ],
        ], null, null, true
        );
    }
}
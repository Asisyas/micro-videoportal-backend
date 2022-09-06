<?php

namespace App\Frontend\File\Facade;

use App\Frontend\File\Validator\Stream\CreateStreamRequestValidatorFactory;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class FileFacade implements FileFacadeInterface
{

    public function __construct(
        private readonly CreateStreamRequestValidatorFactory $createStreamRequestValidatorFactory
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function validateCreateStreamRequest(array $source): ConstraintViolationListInterface|null
    {
        return $this->createStreamRequestValidatorFactory
            ->create($source)
            ->validate();
    }
}
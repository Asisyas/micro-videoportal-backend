<?php

namespace App\Frontend\File\Validator\FileUpload;

use App\Frontend\Common\Validator\ArrayObject\ArrayValidatorFactoryInterface;
use App\Frontend\Common\Validator\ValidatorInterface;

class FileUploadRequestValidatorFactory implements ArrayValidatorFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): ValidatorInterface
    {
        return new FileUploadRequestValidator();
    }
}

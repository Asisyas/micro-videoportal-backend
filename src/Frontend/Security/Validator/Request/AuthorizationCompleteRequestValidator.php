<?php

declare(strict_types=1);

/**
 * This file is part of the Micro framework package.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Frontend\Security\Validator\Request;

use App\Frontend\Common\Validator\ArrayObject\AbstractValidator;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraint;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class AuthorizationCompleteRequestValidator extends AbstractValidator
{

    /**
     * {@inheritDoc}
     */
    protected function createValidationSchema(): Constraint
    {
        return new Assert\Collection([
            'provider'  => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'string']),
            ],
            'code'  => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'string']),
                new Assert\Length([
                    'min'   => 20,
                ]),
            ]
        ]);
    }
}
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

use App\Frontend\Common\Validator\ArrayObject\ArrayValidatorFactoryInterface;
use App\Frontend\Common\Validator\ValidatorInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class AuthorizationCompleteRequestValidatorFactory implements ArrayValidatorFactoryInterface
{
    /**
     * @return ValidatorInterface
     */
    public function create(): ValidatorInterface
    {
        return new AuthorizationCompleteRequestValidator();
    }
}
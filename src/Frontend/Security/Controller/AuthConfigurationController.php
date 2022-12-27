<?php

declare(strict_types=1);

/**
 * This file is part of the Video portal application
 * based on the Micro Framework.
 *
 * (c) Stanislau Komar <head.trackingsoft@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Frontend\Security\Controller;

use App\Frontend\Security\Facade\SecurityFacadeInterface;
use App\Shared\Generated\DTO\Security\AuthConfigurationTransfer;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
class AuthConfigurationController
{
    /**
     * @param SecurityFacadeInterface $securityFacade
     */
    public function __construct(
        private readonly SecurityFacadeInterface $securityFacade
    ) {
    }

    /**
     * @param Request $request
     *
     * @return AuthConfigurationTransfer
     */
    public function receiveConfiguration(Request $request): AuthConfigurationTransfer
    {
        return $this->securityFacade->getAuthConfiguration();
    }
}

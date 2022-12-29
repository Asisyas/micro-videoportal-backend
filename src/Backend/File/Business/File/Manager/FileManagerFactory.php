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

namespace App\Backend\File\Business\File\Manager;

use App\Backend\File\Business\File\Factory\FileFactoryInterface;
use App\Backend\File\Business\File\Storage\FileStorageFactoryInterface;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
readonly class FileManagerFactory implements FileManagerFactoryInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param FileFactoryInterface $fileFactory
     * @param FileStorageFactoryInterface $fileStorageFactory
     * @param FilesystemFacadeInterface $filesystemFacade
     */
    public function __construct(
        private DoctrineFacadeInterface $doctrineFacade,
        private FileFactoryInterface $fileFactory,
        private FileStorageFactoryInterface $fileStorageFactory,
        private FilesystemFacadeInterface $filesystemFacade
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(): FileManagerInterface
    {
        return new FileManager(
            $this->fileFactory,
            $this->doctrineFacade->getManager(),
            $this->fileStorageFactory->create(),
            $this->filesystemFacade->createFsOperator()
        );
    }
}

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
use App\Backend\File\Business\File\Storage\FileStorageInterface;
use App\Backend\File\Entity\File;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Doctrine\ORM\EntityManagerInterface;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;

/**
 * @author Stanislau Komar <head.trackingsoft@gmail.com>
 */
readonly class FileManager implements FileManagerInterface
{
    /**
     * @TODO: move delete logic from here
     *
     * @param FileFactoryInterface $fileFactory
     * @param EntityManagerInterface $entityManager //TODO: temporary solution
     * @param FileStorageInterface $fileStorage //TODO: temporary solution
     * @param FilesystemOperator $filesystemOperator //TODO: temporary solution
     */
    public function __construct(
        private FileFactoryInterface $fileFactory,
        private EntityManagerInterface $entityManager,
        private FileStorageInterface $fileStorage,
        private FilesystemOperator $filesystemOperator
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function createFile(FileUploadTransfer $fileUploadTransfer): FileTransfer
    {
        return $this->fileFactory->create($fileUploadTransfer);
    }

    /**
     * TODO: Separate it to an other service
     *
     * {@inheritDoc}
     */
    public function deleteFile(FileRemoveTransfer $fileRemoveTransfer): void
    {
        $fileEntity = $this->entityManager->getRepository(File::class)->findOneBy([
            'id'    => $fileRemoveTransfer->getId(),
        ]);

        if (!$fileEntity) {
            return;
        }

        $this->entityManager->remove($fileEntity);
        $this->entityManager->flush();
        $this->fileStorage->remove($fileRemoveTransfer);

        try {
            $this->filesystemOperator->delete($fileRemoveTransfer->getId());
        } catch (FilesystemException $throwable) {
        }
    }
}

<?php

namespace App\Backend\File\Business\File\Factory;

use App\Backend\File\Business\File\Storage\FileStorageFactoryInterface;
use App\Backend\File\Entity\File;
use App\Shared\Generated\DTO\File\FileCreateTransfer;
use App\Shared\Generated\DTO\File\FileRemoveTransfer;
use App\Shared\Generated\DTO\File\FileTransfer;
use App\Shared\Generated\DTO\File\FileUploadTransfer;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

readonly class FileFactory implements FileFactoryInterface
{
    /**
     * @param UuidFacadeInterface $uuidFacade
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param FileStorageFactoryInterface $fileStorageFactory
     */
    public function __construct(
        private UuidFacadeInterface $uuidFacade,
        private DoctrineFacadeInterface $doctrineFacade,
        private FileStorageFactoryInterface $fileStorageFactory,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function create(FileUploadTransfer $fileUploadTransfer): FileTransfer
    {
        $em = $this->doctrineFacade->getManager();
        $fileStorage = $this->fileStorageFactory->create();

        $file = new File(
            $this->uuidFacade->v4(),
            $fileUploadTransfer->getName(),
            $fileUploadTransfer->getSize(),
            $fileUploadTransfer->getContentType()
        );

        $em->beginTransaction();
        try {
            $em->persist($file);
            $em->flush();

            $fileTransfer = new FileTransfer();

            $fileTransfer->setSize($file->getSize());
            $fileTransfer->setContentType($file->getContentType());
            $fileTransfer->setId($file->getId());
            $fileTransfer->setName($file->getFileName());
            $fileTransfer->setCreatedAt($file->getCreatedAt());

            $fileStorage->put($fileTransfer);

            $em->commit();
        } catch (\Throwable $exception) {
            $em->rollback();

            $fileRemoveTransfer = new FileRemoveTransfer();
            $fileRemoveTransfer->setId($file->getId());
            $fileStorage->remove($fileRemoveTransfer);

            throw $exception;
        }

        return $fileTransfer;
    }
}

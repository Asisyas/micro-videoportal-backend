<?php

namespace App\Backend\Category\Business\Factory;

use App\Backend\Category\Business\Action\ActionProcessorFactoryInterface;
use App\Backend\Category\Business\Expander\CategoryTransfer\CategoryTransferExpanderFactoryInterface;
use App\Backend\Category\Entity\Category;
use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;
use App\Shared\Generated\DTO\Category\CategoryTransfer;
use Micro\Plugin\Doctrine\DoctrineFacadeInterface;
use Micro\Plugin\Uuid\UuidFacadeInterface;

class CategoryFactory implements CategoryFactoryInterface
{
    /**
     * @param DoctrineFacadeInterface $doctrineFacade
     * @param UuidFacadeInterface $uuidFacade
     * @param CategoryTransferExpanderFactoryInterface $categoryTransferExpanderFactory
     * @param ActionProcessorFactoryInterface $postCreateActionProcessor
     */
    public function __construct(
        private readonly DoctrineFacadeInterface $doctrineFacade,
        private readonly UuidFacadeInterface $uuidFacade,
        private readonly CategoryTransferExpanderFactoryInterface $categoryTransferExpanderFactory,
        private readonly ActionProcessorFactoryInterface $postCreateActionProcessor
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function create(CategoryCreateTransfer $createCategoryTransfer): CategoryTransfer
    {
        $category = new Category($this->uuidFacade->v4());
        $category->setName($createCategoryTransfer->getName());
//        $category->setParentCategoryUuid($createCategoryTransfer->getParentUuid());

        $em = $this->doctrineFacade->getManager();
        $em->persist($category);
        $em->flush();

        $categoryTransfer = new CategoryTransfer();

        $this->categoryTransferExpanderFactory->create($category)->expand($categoryTransfer);
        $this->postCreateActionProcessor->create()->process($categoryTransfer);

        return $categoryTransfer;
    }
}
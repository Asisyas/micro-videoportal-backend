<?php

namespace App\Frontend\Category\Controller;

use App\Client\Category\Facade\CategoryClientInterface;
use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController
{
    public function __construct(private readonly CategoryClientInterface $categoryClient)
    {
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function createCategory(Request $request): Response
    {
        $categoryClientTransfer = new CategoryCreateTransfer();
        $categoryClientTransfer->setName('Main');

        $statusResponse = $this->categoryClient->create($categoryClientTransfer);

        return new JsonResponse(
            $statusResponse->toArray(),
        );
    }
}
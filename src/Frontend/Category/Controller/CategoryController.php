<?php

namespace App\Frontend\Category\Controller;

use App\Client\Category\Facade\CategoryClientInterface;
use App\Shared\Generated\DTO\Category\CategoryCreateTransfer;
use Micro\Library\DTO\Object\AbstractDto;
use Micro\Library\DTO\SerializerFacadeInterface;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController
{
    public function __construct(
        private readonly CategoryClientInterface $categoryClient,
        private readonly SerializerFacadeInterface $serializerFacade,
        private readonly SecurityFacadeInterface $securityFacade
    )
    {
    }

    public function restore(Request $request): Response
    {

        $decoded = $this->securityFacade->decodeToken($request->get('token'));

        return new JsonResponse([
            'data' => $decoded->getParameters(),
            'lifetime' => $decoded->getLifetime(),
            'created_at' => $decoded->getCreatedAt(),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response|AbstractDto
     */
    public function createCategory(Request $request): Response|AbstractDto
    {

        $categoryClientTransfer = new CategoryCreateTransfer();
        $categoryClientTransfer->setName('Main');

        $statusResponse = $this->categoryClient->create($categoryClientTransfer);

        //$encoded = $this->securityFacade->generateToken([ 'user'  => $request->get('username')]);

        return $statusResponse;
    }
}
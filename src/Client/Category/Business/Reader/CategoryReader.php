<?php

namespace App\Client\Category\Business\Reader;

use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use App\Shared\Category\Configuration;
use App\Shared\Generated\DTO\Category\CategoryGetRequestTransfer;
use App\Shared\Generated\DTO\Category\CategoryGetResponseTransfer;
use App\Shared\Generated\DTO\Category\CategoryTransfer;
use App\Shared\Generated\DTO\ClientReader\RequestTransfer;

class CategoryReader implements CategoryReaderInterface
{
    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     */
    public function __construct(private readonly ClientReaderFacadeInterface $clientReaderFacade)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function lookup(CategoryGetRequestTransfer $categoryGetRequestTransfer): CategoryGetResponseTransfer
    {
        $request = new RequestTransfer();
        $request->setUuid($categoryGetRequestTransfer->getUuid());
        $request->setIndex(Configuration::CLIENT_READER_INDEX);

        $responseData = $this->clientReaderFacade->lookup($request);

        $response =  new CategoryGetResponseTransfer();
        $response->setCategory(new CategoryTransfer($responseData->getData()));

        return $response;
    }
}
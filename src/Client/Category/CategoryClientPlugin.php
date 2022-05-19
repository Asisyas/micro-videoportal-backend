<?php

namespace App\Client\Category;

use App\Client\Category\Business\Reader\CategoryReaderFactory;
use App\Client\Category\Business\Reader\CategoryReaderFactoryInterface;
use App\Client\Category\Facade\CategoryClientFacade;
use App\Client\Category\Facade\CategoryClientFacadeInterface;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

class CategoryClientPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(CategoryClientFacadeInterface::class, function(ClientReaderFacadeInterface $clientReaderFacade) {
            return $this->createClient($clientReaderFacade);
        });
    }

    /**
     * @return CategoryClientFacadeInterface
     */
    protected function createClient(ClientReaderFacadeInterface $clientReaderFacade): CategoryClientFacadeInterface
    {
        return new CategoryClientFacade(
            $this->createCategoryReaderFactory($clientReaderFacade)
        );
    }

    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     * @return CategoryReaderFactoryInterface
     */
    protected function createCategoryReaderFactory(ClientReaderFacadeInterface $clientReaderFacade): CategoryReaderFactoryInterface
    {
        return new CategoryReaderFactory($clientReaderFacade);
    }

}
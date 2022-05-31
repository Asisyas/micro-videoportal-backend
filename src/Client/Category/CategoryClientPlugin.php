<?php

namespace App\Client\Category;

use App\Client\Amqp\Client\AmqpClientInterface;
use App\Client\Category\Business\Manager\CategoryManagerFactory;
use App\Client\Category\Business\Manager\CategoryManagerFactoryInterface;
use App\Client\Category\Business\Reader\CategoryReaderFactory;
use App\Client\Category\Business\Reader\CategoryReaderFactoryInterface;
use App\Client\Category\Configuration\CategoryClientPluginConfigurationInterface;
use App\Client\Category\Facade\CategoryClient;
use App\Client\Category\Facade\CategoryClientInterface;
use App\Client\ClientReader\Facade\ClientReaderFacadeInterface;
use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;

/**
 * @method CategoryClientPluginConfigurationInterface configuration()
 */
class CategoryClientPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(CategoryClientInterface::class, function(
            ClientReaderFacadeInterface $clientReaderFacade,
            AmqpClientInterface $amqpClient
        ) {
            return $this->createClient(
                $clientReaderFacade,
                $amqpClient
            );
        });
    }

    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     * @param AmqpClientInterface $amqpClient
     *
     * @return CategoryClientInterface
     */
    protected function createClient(
        ClientReaderFacadeInterface $clientReaderFacade,
        AmqpClientInterface $amqpClient
    ): CategoryClientInterface
    {
        return new CategoryClient(
            $this->createCategoryReaderFactory($clientReaderFacade),
            $this->createCategoryManagerFactory($amqpClient)
        );
    }

    /**
     * @param AmqpClientInterface $amqpFacade
     *
     * @return CategoryManagerFactoryInterface
     */
    protected function createCategoryManagerFactory(AmqpClientInterface $amqpFacade): CategoryManagerFactoryInterface
    {
        $publisherName = $this->configuration()->getAmqpCategoryCreatePublisher();
        return new CategoryManagerFactory(
            $amqpFacade,
            $publisherName,
            $publisherName,
            $publisherName
        );
    }

    /**
     * @param ClientReaderFacadeInterface $clientReaderFacade
     *
     * @return CategoryReaderFactoryInterface
     */
    protected function createCategoryReaderFactory(ClientReaderFacadeInterface $clientReaderFacade): CategoryReaderFactoryInterface
    {
        return new CategoryReaderFactory($clientReaderFacade);
    }

}